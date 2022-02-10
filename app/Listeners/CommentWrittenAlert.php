<?php

namespace App\Listeners;

use Throwable;
use App\Events\CommentWritten;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentWrittenAlert
{
    public function handle(CommentWritten $event)
    {
        try {
            if($event->comment):
                Session::flash('message', "Your has been submitted Successfully");
            endif;
        
            $commentsWritten = Auth::user()->comments;
        
            $achievement = match (count($commentsWritten)) {
                1  => 'Congratulations you have unlocked an Achievement by writing the First Comment!',
                3  => 'Congratulations you have unlocked an Achievement by writing the 3 Comments!',
                5  => 'Congratulations you have unlocked an Achievement by writing the 5 Comments!',
                10 => 'Congratulations you have unlocked an Achievement by writing the 10 Comments!',
                20 => 'Congratulations you have unlocked an Achievement by writing the 20 Comments!',
                default => false,
            };

            Session::flash('achievement', $achievement);
        }
        catch (Throwable $e) {
            report($e);
     
            return false;
        }
    }
}
