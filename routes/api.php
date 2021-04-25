<?php

use Illuminate\Http\Request;

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('transkrip', function() {
    $kata = 'Selamat datang di ASR, lakukan transkrip dengan mengirim method POST dan file.wav suara yang akan ditranskrip';
    return $kata;
});

Route::post('transkrip', function(Request $request) {
      
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
      
      return response()->json([
          'transkrip' => $sentence,
      ]);
      
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
