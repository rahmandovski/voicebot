<?php

namespace App\Http\Conversations;

use Validator;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

use BotMan\BotMan\Messages\Attachments\Audio;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

use App\Tabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Ixudra\Curl\Facades\Curl;


class OnboardingConversation extends Conversation
{
    public function askName()
    {


        $this->ask('Boleh tau nama kamu siapa?', function (Answer $answer) {
            $this->bot->userStorage()->save([
                'nama' => $answer->getText(),
            ]);
            // Create attachment
            $attachment = new Audio(url('audio/Pertanyaan/askName(reply).mp3'), [
                    'custom_payload' => true,
                ]);

            // Build message object
            $message = OutgoingMessage::create('Baik, '.$answer->getText(). '. Aku Telco, asisten virtual yang siap membantu kamu.')->withAttachment($attachment);

            // Reply message object
            $this->bot->reply($message);
            $this->askKeluhan();
            });

        
    }

    public function askKeluhan()
    {
        $question = Question::create('Ada keluhan yang ingin disampaikan?')
            ->callbackId('predict_kelas')
            ->addButtons([
                Button::create("Ya")->value("Ya"),
                Button::create("Tidak")->value("Tidak"),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue(); 
            }
            if(strcmp($selectedValue,"Ya")==0) {
                $this->askDetailKeluhan();
            }else{
                 $attachment = new Audio(url('audio/Pertanyaan/penutup.mp3'), [
                        'custom_payload' => true,
                    ]);

                // Build message object
                $message = OutgoingMessage::create('Terimakasih telah menghubungi Telco, sampai berjumpa lagi!')->withAttachment($attachment);

                // Reply message object
                $this->bot->reply($message);
               // $this->say("Terimakasih telah menghubungi Telco, sampai berjumpa lagi!");
            }
        });
    }

    public function askDetailKeluhan()
    {

        $this->ask('Baik, mohon maaf sebelumnya, boleh tolong ceritakan keluhan anda?', function (Answer $answer) {
            $this->bot->userStorage()->save([
                'keluhan' => $answer->getText(),
            ]);
             $attachment = new Audio(url('audio/Pertanyaan/askDetailKeluhan(reply).mp3'), [
                    'custom_payload' => true,
                ]);

            // Build message object
            $message = OutgoingMessage::create('Mohon maaf atas ketidaknyamanan yang anda alami')->withAttachment($attachment);

            // Reply message object
            $this->bot->reply($message);
            //$this->say('Mohon maaf atas ketidaknyamanan yang anda alami');
            $this->predict($answer->getText());

        });
    }

    public function predict($script)
    {
        $panggil = Curl::to('http://36.66.152.250:8080/predict4')
                       ->withData(array('phrase'=>$script))
                       ->asJson()
                       ->post();    
        // Convert JSON string to Array
        $kelas = (array) $panggil;
        //$this->updateTabel($kelas);
        $kelas1 = $kelas["1."];
        $kelas2 = $kelas["2."];
        $kelas3 = $kelas["3."];
        $kelas4 = $kelas["4."];
        $this->bot->userStorage()->save([
                'kelas1' => $kelas1,
                'kelas2' => $kelas2,
                'kelas3' => $kelas3,
                'kelas4' => $kelas4,
        ]);
        $this->updateTabel();

        $question = Question::create('Pilihlah jenis keluhan yang anda alami')
            ->callbackId('predict_kelas')
            ->addButtons([
                Button::create($kelas1)->value($kelas1),
                Button::create($kelas2)->value($kelas2),
                Button::create($kelas3)->value($kelas3),
                Button::create($kelas4)->value($kelas4),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue(); 
            }
            $this->bot->userStorage()->save([
                'kelas' => $selectedValue,
            ]);
            $this->jawaban();
        });

        
    }

    public function updateTabel()
    {
        $user = $this->bot->userStorage()->find();

        $tabel = new Tabel();
        $tabel->script = $user->get('keluhan');
        $tabel->konteks1 = $user->get('kelas1');
        $tabel->konteks2 = $user->get('kelas2');
        $tabel->konteks3 = $user->get('kelas3');
        $tabel->konteks4 = $user->get('kelas4');
        $tabel->model = '4';
        $tabel->save();
    }

    public function jawaban()
    {
        $user = $this->bot->userStorage()->find();

        $komplainTeknis = new Audio(url('audio/Pertanyaan/komplainTeknis.mp3'), [
                    'custom_payload' => true,
        ]);
        $komplainNonTeknis = new Audio(url('audio/Pertanyaan/komplainNonTeknis.mp3'), [
                    'custom_payload' => true,
        ]);
        $informasi = new Audio(url('audio/Pertanyaan/informasi.mp3'), [
                    'custom_payload' => true,
        ]);
        $registrasi = new Audio(url('audio/Pertanyaan/registrasi.mp3'), [
                    'custom_payload' => true,
        ]);
        $komplainBilling = new Audio(url('audio/Pertanyaan/komplainBilling.mp3'), [
                    'custom_payload' => true,
        ]);

        if (strcmp($user->get('kelas'),'GANGGUAN INTERNET')==0) {
            $message = OutgoingMessage::create('Baik, keluhan anda akan kami proses ke bagian "KOMPLAIN TEKNIS" <br>Langkah awal kamu bisa ikuti panduan berikut ini :<br>1. Matikan modem, cabut kabel berwarna biru yang berada dibelakang modem.<br>2. Cabut dan pasang kembali kabel power serta kabel port 3 pada modem<br>3. Kemudian hidupkan kembali modemnya')->withAttachment($komplainTeknis);
                $this->bot->reply($message);
        }elseif (strcmp($user->get('kelas'),'GANGGUAN TELEPON')==0) {
            $message = OutgoingMessage::create('Baik, keluhan anda akan kami proses ke bagian "KOMPLAIN TEKNIS"<br>Langkah awal kamu bisa ikuti panduan berikut ini :<br>1. Matikan perangkat modem<br>2. Cabut kabel telepon dan kabel berwarna biru yang berada pada bagian belakang modem<br>3. Pasang kembali semua kabel yang sebelumnya dicabut<br>4. Kemudian nyalakan kembali perangkat modemnya')->withAttachment($komplainTeknis);
                $this->bot->reply($message);
        }elseif (strcmp($user->get('kelas'),'GANGGUAN USEE TV')==0) {
            $message = OutgoingMessage::create('Baik, keluhan anda akan kami proses ke bagian "KOMPLAIN TEKNIS" <br>Langkah awal kamu bisa ikuti panduan berikut ini :<br>1. Matikan STB<br>2. Cek kabel LAN antara ONT dan STB pastikan sudah di port yang sesuai atau port4 untuk STB pertama dan LAN 1 untuk STB ke dua<br>3. Cabut dan pasang kembali kabel LAN yang terhubung ke STB<br>4. Kemudian nyalakan kembali STB nya')->withAttachment($komplainTeknis);
                $this->bot->reply($message);
        }elseif (strcmp($user->get('kelas'),'INFO PROMO')==0) {
            $message = OutgoingMessage::create('Baik, keluhan anda akan kami proses ke bagian "INFORMASI".<br>Promo yang tersedia:<br>1. Promo belajar online dari rumah<br>2. Paket game online<br>3. Paket khusus guru')->withAttachment($informasi);
                $this->bot->reply($message);
        }elseif ((strcmp($user->get('kelas'),'INFO PRODUK')==0) || (strcmp($user->get('kelas'),'INFO TAGIHAN')==0) || (strcmp($user->get('kelas'),'INFO STATUS TIKET KOMPLAIN')==0) || (strcmp($user->get('kelas'),'INFO STATUS REGISTRASI')==0) || (strcmp($user->get('kelas'),'INFO PAKET LANGGANAN')==0)) {
           $message = OutgoingMessage::create('Baik, keluhan anda akan kami proses ke bagian "INFORMASI" dengan data yang telah anda berikan<br>Nama: '.$user->get('nama').'<br>Keluhan: "'.$user->get('keluhan').'"')->withAttachment($informasi);
            $this->bot->reply($message);
        }elseif ((strcmp($user->get('kelas'),'PASANG BARU')==0) || (strcmp($user->get('kelas'),'REGISTRASI MY INDIHOME')==0)) {
             $message = OutgoingMessage::create('Baik, keluhan anda akan kami proses ke bagian "REGISTRASI" dengan data yang telah anda berikan<br>Nama: '.$user->get('nama').'<br>Keluhan: "'.$user->get('keluhan').'"')->withAttachment($registrasi);
                $this->bot->reply($message);
        }elseif ((strcmp($user->get('kelas'),'TAGIHAN MELONJAK')==0) || (strcmp($user->get('kelas'),'TAGIHAN TIDAK SESUAI')==0) ) {
            $message = OutgoingMessage::create('Baik, keluhan anda akan kami proses ke bagian "KOMPLAIN BILLING" dengan data yang telah anda berikan<br>Nama: '.$user->get('nama').'<br>Keluhan: "'.$user->get('keluhan').'"')->withAttachment($komplainBilling);
                $this->bot->reply($message);
        }elseif ((strcmp($user->get('kelas'),'LAMPU LOS MENYALA MERAH')==0) || (strcmp($user->get('kelas'),'PERANGKAT TIDAK BERFUNGSI')==0)) {
            $message = OutgoingMessage::create('Baik, keluhan anda akan kami proses ke bagian "KOMPLAIN TEKNIS" dengan data yang telah anda berikan<br>Nama: '.$user->get('nama').'<br>Keluhan: "'.$user->get('keluhan').'"')->withAttachment($komplainTeknis);
                $this->bot->reply($message);
        }elseif ((strcmp($user->get('kelas'),'BUKA ISOLIR')==0) || (strcmp($user->get('kelas'),'MIGRASI PAKET')==0) || (strcmp($user->get('kelas'),'PERMINTAAN RINCIAN TAGIHAN')==0) || (strcmp($user->get('kelas'),'PERMINTAAN CABUT (ATAS PERMINTAAN SENDIRI)')==0) || (strcmp($user->get('kelas'),'BATAL CABUT (ATAS PERMINTAAN SENDIRI)')==0) || (strcmp($user->get('kelas'),'PERMINTAAN ISOLIR (ATAS PERMINTAAN SENDIRI)')==0) || (strcmp($user->get('kelas'),'PERMINTAAN MUTASI (BALIK NAMA/GANTI NOMOR, DLL)')==0) || (strcmp($user->get('kelas'),'KOMPLAIN SLG')==0) || (strcmp($user->get('kelas'),'PERMINTAAN TAMBAH FITUR (ADD ON)')==0) || (strcmp($user->get('kelas'),'PERMINTAAN CABUT FITUR')==0) || (strcmp($user->get('kelas'),'PERMINTAAN PASANG KEMBALI')==0) || (strcmp($user->get('kelas'),'PEMBATALAN ORDER PSB/MIGRASI')==0) || (strcmp($user->get('kelas'),'PERMINTAAN INCOMING ONLY')==0) || (strcmp($user->get('kelas'),'PERMINTAAN OUTGOING ONLY')==0) || (strcmp($user->get('kelas'),'BLOCKING SLJJ')==0) || (strcmp($user->get('kelas'),'BLOCKING NOMOR PONSEL TERTENTU')==0) || (strcmp($user->get('kelas'),'BLOCKING SLI')==0)) {
            $message = OutgoingMessage::create('Baik, keluhan anda akan kami proses ke bagian "KOMPLAIN NON TEKNIS" dengan data yang telah anda berikan<br>Nama: '.$user->get('nama').'<br>Keluhan: "'.$user->get('keluhan').'"')->withAttachment($komplainNonTeknis);
                $this->bot->reply($message);
        }else{
            $this->say('Baik, keluhan anda akan kami proses dengan data yang telah anda berikan<br>Nama: '.$user->get('nama').'<br>Keluhan: "'.$user->get('keluhan').'"');
        }
        $this->stopConversation();

    }

    public function stopConversation()
    {
        $question = Question::create('Apakah anda ingin mengakhiri percakapan ini?')
            ->callbackId('akhir')
            ->addButtons([
                Button::create("Ya")->value("Ya"),
                Button::create("Tidak")->value("Tidak"),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue(); 
            }
            if(strcmp($selectedValue,"Ya")==0) {
                $this->say("Terimakasih telah menghubungi Telco, sampai berjumpa lagi!");
            }else{
                $this->askKeluhan();
            }
        });
    }

    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askName();
    }
}
