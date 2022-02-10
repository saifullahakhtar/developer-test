<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Events\LessonWatched;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{

    public function index($course)
    {
        $lessons = Lesson::all();

        return view('lessons.index', compact('lessons', 'course'));
    }
    
    public function view(Lesson $lesson)
    {
        $lesson       = Lesson::find($lesson)->first();
        $nextLessons  = Lesson::where('id', '>', $lesson->id)->paginate(8);
        $lessonStatus = Auth::user()->watched->find($lesson->id);

        return view('lessons.view', compact('lesson', 'nextLessons', 'lessonStatus'));
    }

    public function watch(Request $request)
    {
        $lesson = Lesson::where('id', $request->lesson_id)->first();
        $user   = Auth::user();

        event(new LessonWatched($lesson, $user));

        return redirect()->back();
    }

    public function myLessons(User $user)
    {
        $myLessons = $user->lessons;

        return view('lessons.my-lessons', compact('myLessons'));
    }

}
