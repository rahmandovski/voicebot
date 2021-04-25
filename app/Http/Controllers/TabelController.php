<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

use Illuminate\Support\Facades\DB;
use \App\Tabel;

class TabelController extends Controller
{
    public function show()
    {
        #get data untuk ditampilin di tabel dari database

        $file = DB::table('integrasi')->orderBy('created_at', 'desc')->get()->toArray();

        #sementara
        // $file = [
        //     'id' => '1',
        //     'wav' => 'cek.wav',
        //     'transcript' => 'null',
        //     'prediksi' => 'null'
        // ];
        return view('table', ['file'=>$file]);
    }

    public function transcript($id)
    {
        $client = new Client(['base_uri' => 'http://36.66.152.250:9900/']);

        //get nama file suara
        $nama_file = DB::table('integrasi')
                ->where('id', $id)
                ->get(['path_audio']); 
        $nama_file = $nama_file->toArray();
        foreach ($nama_file as $key => $object) {
            $nama =  $object->path_audio;
        }
        $file_suara = base_path().'/public/audio/'.$nama;
        
        //sementara
        //public_path() nanti diganti sama path simpen filenya dimana
        //$file_suara = public_path().'/cek.wav';
        
        $response = $client->request('POST', '/get-transcript', [
            'multipart' => [
                [
                    'name'     => 'voice',
                    'contents' => fopen($file_suara, 'r')
                ]
            ]
        ]);
        $hasil = json_decode($response->getBody());
        $sentence='';
        foreach ($hasil as $key) {
            $sentence .= ' '.$key->words;
        }

        //update transkrip ke database
        $check = DB::table('integrasi')
              ->where('id', $id)
              ->update(['script' => $sentence]);

        //sementara
        // $file = [
        //     'id' => '1',
        //     'wav' => 'cek.wav',
        //     'transcript' => $sentence,
        //     'prediksi' => 'null'
        // ];

        //bisa return redirect aja
        // $file = DB::table('nama tabel')->get()->toArray();
        // return view('table', $file);
        return redirect('/tabel')->with('sukses', 'berhasil');
    }
    public function predict(Request $request, $id){

        //get transkrip by id
        $transcript = DB::table('integrasi')
                ->where('id', $id)
                ->get(['script']); 
        $script = $transcript->toArray();
        foreach ($script as $key => $object) {
            $kalimat =  $object->script;
        }
        $model = $request->model;
        print_r($model);

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
        
        $konteks1 = $kelas["1."];
        $konteks2 = $kelas["2."];
        $konteks3 = $kelas["3."];
        $konteks4 = $kelas["4."];
        
        //update kelas prediksi di db
        $check = DB::table('integrasi')
              ->where('id', $id)
              ->update(['konteks1' => $konteks1, 'konteks2' => $konteks2, 'konteks3' => $konteks3, 'konteks4' => $konteks4 ,'model' => $model]);
        
        
         return redirect('/tabel')->with('sukses', 'berhasil');
    }

}
