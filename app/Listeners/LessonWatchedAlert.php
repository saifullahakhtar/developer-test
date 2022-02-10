<?php

namespace App\Listeners;

use Throwable;
use App\Events\LessonWatched;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LessonWatchedAlert
{
    public function handle(LessonWatched $event)
    {
        try {
            if(DB::table('lesson_user')->where('user_id', $event->user->id)->where('lesson_id', $event->lesson->id)->doesntExist()):
                
                $lessonWatched = DB::table('lesson_user')->insert([
                    'user_id'   => $event->user->id,
                    'lesson_id' => $event->lesson->id,
                    'watched'   => true,
                ]);

                if($lessonWatched):
                    Session::flash('message', "You have successfully completed the Lesson No: " . $event->lesson->id);
                endif;
        
                $lessonsWatched = Auth::user()->watched;
        
                $achievement = match (count($lessonsWatched)) {
                    1  => 'Congratulations you have unlocked an Achievement by watching the First Lesson!',
                    5  => 'Congratulations you have unlocked an Achievement by watching the 5 Lessons!',
                    10 => 'Congratulations you have unlocked an Achievement by watching the 10 Lessons!',
                    25 => 'Congratulations you have unlocked an Achievement by watching the 25 Lessons!',
                    50 => 'Congratulations you have unlocked an Achievement by watching the 50 Lessons!',
                    default => false,
                };

                Session::flash('achievement', $achievement);
                
            else:
                throw new \ErrorException('Already Exist');
            endif;
        }
        catch (Throwable $e) {
            report($e);
     
            return false;
        }
    }
}
