<?php

namespace App\Http\Controllers;
use App\TextToSpeech\TextToSpeech;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Ixudra\Curl\Facades\Curl;
class TTSController extends Controller
{
   	public function konversiI(Request $request)
   	{
         $txt = $request->txt;
         if (is_null($txt)) {
            return view('tts');
         }else{
            $panggil = Curl::to('http://36.66.152.250:8080/texttospeech')
                     ->withData(array('text'=>$txt))
                     ->asJson()
                     ->post();
            $audio =  convert($panggil);
            return view('tts',['audio' => $audio]);
         }
        
   	}
      public function konversi(Request $request)
      {
         $txt = $request->txt;
         if (is_null($txt)) {
            return view('tts');
         }else{
            $gTTS = new TextToSpeech;
            $gTTS->setMessage($txt);
            $stat = TRUE;
            $audio =  $gTTS->convert($stat);
            return view('tts',['audio' => $audio]);
         }
        
      }
      public function tes(){
         /*$process = new process(['C:\Users\firditama\AppData\Local\Programs\Python\Python36-32\python.exe','\F:\file_telkom\hello.py']);
         $process->run();

         if (!$process->isSuccessful()) {
             throw new ProcessFailedException($process);
         }

         echo $process->getOutput();*/
         //echo $_SERVER['DOCUMENT_ROOT'];
         $output = shell_exec('python record.py');
         echo "<pre>$output</pre>";
         //return redirect('/tabel');
      }
}
