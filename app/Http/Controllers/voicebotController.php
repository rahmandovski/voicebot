<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

class voicebotController extends Controller
{
    public function predict($sentence)
    {
       $panggil = Curl::to('https://telkom-api.indihealth-rtc.xyz/predict-dt')
                     ->withData(array('phrase'=>$sentence))
                     ->asJson()
                     ->post();
        // Convert JSON string to Array

        $kelas = (array) $panggil;
       // print_r($kelas);
        $konteks1 = $kelas["1."];
        $konteks2 = $kelas["2."];
        $konteks3 = $kelas["3."];
        $konteks4 = $kelas["4."];
        return  $konteks1;
    } 
 public function transcriptA(Request $request)
    {
      //transkrip ASR EU
      $file = $request->file('voice')->store('audio');
     
      $client = new Client(['base_uri' => 'https://telkom-api.indihealth-rtc.xyz/']);

        $file_suara = $request->file('voice');
        
        $response = $client->request('POST', '/transkrip', [
            'multipart' => [
                [
                    'name'     => 'voice',
                    'contents' => fopen($file_suara, 'r')
                ]
            ]
        ]);
        $hasil = json_decode($response->getBody());
    
        $sentence = $hasil->{'transkrip'};
        return $this->rule($sentence);
    }
    public function transcriptB(Request $request)
    {
      //transcript ASR GOOGLE
      $file = $request->file('voice')->store('audio');

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
    
        $sentence = strtoupper($hasil->{'transkrip'});
        return $this->rule($sentence);
    }

    public function rule($sentence)
    {
      if(preg_match("/terima\s?kasih/i", $sentence)|| preg_match("/makasih/i", $sentence)|| preg_match("/tidak/i", $sentence)){
            $jawaban = "Terima kasih kembali, apabila tidak ada lagi yang bisa dibantu. Kalau begitu saya akhiri ya, sampai jumpa!";
            //$audio = $this->konversi($jawaban);
            $path_audio = "penutup.mp3";
          }elseif (preg_match("/selamat pagi/i", $sentence)) {
            $jawaban = "Selamat pagi, ada yang bisa dibantu?";
            //$audio = $this->konversi($jawaban);
            $path_audio = "pagi.mp3";
          }elseif (preg_match("/selamat siang/i", $sentence)) {
            $jawaban = "Selamat siang, ada yang bisa dibantu?";
            $path_audio = "siang.mp3";
          }elseif (preg_match("/selamat sore/i", $sentence)) {
            $jawaban = "Selamat sore, ada yang bisa dibantu?";
            $path_audio = "sore.mp3";
          }elseif (preg_match("/selamat malam/i", $sentence)) {
            $jawaban = "Selamat malam, ada yang bisa dibantu?";
            $path_audio = "malam.mp3";
          }elseif (preg_match("/[Hh][ae]l*o/i", $sentence)) {
            $jawaban = "Halo, ada yang bisa dibantu?";
            $path_audio = "halo.mp3";
          }elseif (preg_match("/[Hh][ae][iy]/i", $sentence)) {
            $jawaban = "Hai, ada yang bisa dibantu?";
            $path_audio = "hai.mp3";
          }else{
          	$konteks = $this->predict($sentence);
                  
           $jawaban = "Baik berdasarkan hasil analisis, permasalahan anda tergolong pada "  .$konteks. ". Tim " .$konteks. " akan segera menindak lanjuti. Ada yang bisa dibantu lagi?";
            if($konteks == "INFORMASI"){
                $path_audio = "informasi.mp3";
            }elseif ($konteks == "KOMPLAIN NON TEKNIS") {
              $path_audio = "komplainNonTeknis.mp3";
            }elseif ($konteks == "KOMPLAIN TEKNIS") {
              $path_audio = "komplainTeknis.mp3";
            }elseif($konteks == "KOMPLAIN BILLING"){
              $path_audio = "komplainBilling.mp3";
            }elseif ($konteks == "REGISTRASI") {
              $path_audio = "registrasi.mp3";
            }
            //$audio = $this->konversi($jawaban);
          }

      $return_arr[] = array("sentence" => $sentence,
                    "jawaban" => $jawaban,
                    "path" => $path_audio,
                    //"audio"=>$audio
                  );

      return $return_arr;
    }

  public function inputKalimat(Request $request)
  {
    $kalimat = $request->input('kalimat');
   
    return $this->rule($kalimat);

  }
public function inputKalimatTidak(Request $request)
  {
    $kalimat = $request->kalimat;
   
    return $this->rule($kalimat);

  }
}
