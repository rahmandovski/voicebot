<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class ClientController extends Controller
{
   public function getData(Request $request)
    {
      $kalimat = $request->kalimat;
      $model = $request->model;
      //print_r($model);
      if ($model == 1) {
        $panggil = Curl::to('http://36.66.152.250:8080/predict-dt')
                   ->withData(array('phrase'=>$kalimat))
                   ->asJson()
                   ->post();
      }else{
          $panggil = Curl::to('http://36.66.152.250:8080/predict'.$model)
               ->withData(array('phrase'=>$kalimat))
                ->asJson()
                ->post();
      }
      // Convert JSON string to Array
      $kelas = (array) $panggil;
     print_r($kelas);        
      return view('prediksi', ['kelas' => $kelas, 'kalimat'=> $kalimat]);
    }


   public function ambil(Request $request)
    {
      $file = $request->file('voice')->store('audio');
      $jumlah = $request->get('jumlah');

      $client = new Client(['base_uri' => 'https://telkom-web.indihealth-rtc.xyz/']);

        $file_suara = $request->file('voice');
        
        $response = $client->request('POST', '/api/transkrip', [
            'multipart' => [
                [
                    'name'     => 'voice',
                    'contents' => fopen($file_suara, 'r')
                ]
            ]
        ]);
        $hasil = json_decode($response->getBody());
    
        $sentence = $hasil->{'transkrip'};
    

        return $this->rule($jumlah, $sentence);
    }

    public function rule($jumlah, $sentence)
    {
      $pola = "/terima\s?kasih/i";
      if(preg_match($pola, $sentence)){
         $jawaban = "Terimakasih telah menghubungi Telco, sampai berjumpa lagi!";
         $path_audio = "penutup.mp3";
       }else{
           $panggil = Curl::to('http://36.66.152.250:8080/predict-dt')
                     ->withData(array('phrase'=>$sentence))
                     ->asJson()
                     ->post();
          // Convert JSON string to Array
          $kelas = (array) $panggil;
          
          $konteks1 = $kelas["1."];
          $konteks2 = $kelas["2."];
          $konteks3 = $kelas["3."];
          $konteks4 = $kelas["4."];
          $jawaban = "Keluhan anda termasuk dalam " .$konteks1. ". Keluhan akan segera kami teruskan dan proses di bagian penanganan  " .$konteks1. ".";
          if($konteks1 == "INFORMASI"){
              $path_audio = "informasi.mp3";
          }elseif ($konteks1 == "KOMPLAIN NON TEKNIS") {
            $path_audio = "komplainNonTeknis.mp3";
          }elseif ($konteks1 == "KOMPLAIN TEKNIS") {
            $path_audio = "komplainTeknis.mp3";
          }elseif($konteks1 == "KOMPLAIN BILLING"){
            $path_audio = "komplainBilling.mp3";
          }elseif ($konteks1 == "REGISTRASI") {
            $path_audio = "registrasi.mp3";
          }
      }

      $return_arr[] = array("sentence" => $sentence,
                    "jawaban" => $jawaban,
                    "jumlah" => $jumlah,
                    "path" => $path_audio);

      return $return_arr;
    }
}
