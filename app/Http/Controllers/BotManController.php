<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Http\Conversations\OnboardingConversation;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');
        $botman->hears('{message}', function($botman, $message) {
            //$botman->reply('OK');
            $botman->startConversation(new OnBoardingConversation);
      });
      $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php.
     *
     * @param BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        
    }
}
