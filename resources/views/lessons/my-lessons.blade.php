@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mt-3 mb-5 text-center fs-2 text-uppercase fw-bold">My Lessons</h1>

    <div class="row g-5">

        @foreach ($myLessons as $lesson)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header p-0">
                        <img src="//fakeimg.pl/340x220/?text=Lesson {{ $lesson->id }}" class="img-fluid" alt="Lesson Image">
                    </div>
                    <div class="card-body">
                        <h6 class="mt-2">
                            {{ $lesson->title }}
                        </h6>
                        <a href="/lessons/{{ $lesson->id }}" class="mt-1 btn btn-sm btn-primary">
                            <i class="fa fa-eye d-inline-block me-1"></i> View Lesson
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection
