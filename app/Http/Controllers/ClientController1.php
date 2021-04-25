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

class ClientController1 extends Controller
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
     // print_r($kelas);        
      return view('prediksi', ['kelas' => $kelas, 'kalimat'=> $kalimat]);
    }


    public function ambil(Request $request)
    {
      $file = $request->file('voice')->store('audio');
      
      $jumlah = $request->get('jumlah');
      $file_suara = $request->file('voice');
      
      // $audioFile = 'path to an audio file';
      // change these variables if necessary
      $encoding = AudioEncoding::LINEAR16;
      $sampleRateHertz = 48000;
      $languageCode = 'id';
      // get contents of a file into a string
      $content = file_get_contents($file_suara);
      
      // set string as audio content
      $audio = (new RecognitionAudio())
              ->setContent($content);
      // set config
      $config = (new RecognitionConfig())
              ->setEncoding($encoding)
              ->setLanguageCode($languageCode);
      // create the speech client
      $client = new SpeechClient();
      
      // create the asyncronous recognize operation
      $operation = $client->longRunningRecognize($config, $audio);
      $operation->pollUntilComplete();
      
      if ($operation->operationSucceeded()) {
          $response = $operation->getResult();
      
      // each result is for a consecutive portion of the audio. iterate
      // through them to get the transcripts for the entire audio file.
          $sentence='';
          foreach ($response->getResults() as $result) {
                  $alternatives = $result->getAlternatives();
                  $mostLikely = $alternatives[0];
                  $transcript = $mostLikely->getTranscript();
                  $confidence = $mostLikely->getConfidence();
                  
                  $sentence .= ' '.$transcript;
          }
      } else {
          print_r($operation->getError());
      }
      $client->close();


      //$client = new Client(['base_uri' => 'http://36.66.152.250:9900/']);

        //$file_suara = $request->file('voice');
        
        //$response = $client->request('POST', '/get-transcript', [
          //  'multipart' => [
            //    [
              //      'name'     => 'voice',
                //    'contents' => fopen($file_suara, 'r')
                //]
            //]
        //]);
        //$hasil = json_decode($response->getBody());
        //$sentence='';
        //foreach ($hasil as $key) {
            //$sentence .= ' '.$key->words;
        //};

        //return $sentence;
        return $this->rule($jumlah, $sentence);

        
    }

    public function rule($jumlah, $sentence)
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
          }elseif (preg_match("/h[ae]l*o/i", $sentence)) {
            $jawaban = "Halo, ada yang bisa dibantu?";
            $path_audio = "halo.mp3";
          }elseif (preg_match("/h[ae][iy]/i", $sentence)) {
            $jawaban = "Hai, ada yang bisa dibantu?";
            $path_audio = "hai.mp3";
           } else{
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
            $jawaban = "Baik berdasarkan hasil analisis, permasalahan anda tergolong pada "  .$konteks1. ". Tim " .$konteks1. " akan segera menindak lanjuti. Ada yang bisa dibantu lagi?";
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
            //$audio = $this->konversi($jawaban);
          }

      $return_arr[] = array("sentence" => $sentence,
                    "jawaban" => $jawaban,
                    "jumlah" => $jumlah,
                    "path" => $path_audio,
                    //"audio"=>$audio
                  );

      return $return_arr;
    }
}
