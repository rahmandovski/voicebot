<?php 
namespace App\TextToSpeech{
/**
 * Google Text To Speech Library
 *
 * A simple library to use the unofficial Google Translate API
 * to create a Text To Speech audio file
 */

    class TextToSpeech
    {

        private $text;
        private $lang = 'ID';

        public function setMessage($text)
        {
            // Google Translate API cannot handle strings > 100 characters
            $text = substr($text, 0, 200);
            $text=htmlspecialchars($text);
            $text=rawurlencode($text);
            
            $this->text = $text;
        }

        public function convert($autoplay_status = FALSE)
        {
            

            $text_len = strlen($this->text);
           
            $url = 'http://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='. $this->text;
            $url .= '&textlen=' . $text_len . '&tl=' . $this->lang;

            $mp3 = file_get_contents( $url );
           
            $result = "<source src='data:audio/mpeg;base64," . base64_encode($mp3) . "' />\n";
            return $result;
        }
    }
}