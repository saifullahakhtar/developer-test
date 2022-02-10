@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mt-0">

        <div class="position-fixed w-auto mb-3 me-3 bottom-0 end-0 z-index-high">
            @if (session('message'))
                <div class="toast show bg-white" style="--bs-bg-opacity: .95;">
                    <div class="toast-header bg-secondary">
                        <strong class="me-auto text-white">Congratulations</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        <p>{{ session('message') }}</p>
                    </div>
                </div>
            @endif
            @if(session('achievement'))
                <div class="toast show bg-white mt-2" style="--bs-bg-opacity: .9;">
                    <div class="toast-header bg-secondary">
                        <strong class="me-auto text-white">Achievement Unlocked</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        <p>{{ session('achievement') }}</p>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-md-9">
            <div class="lesson-image col-6">
                <img src="https://fakeimg.pl/950x450/?text=Video Playing">
            </div>
            <h1 class="my-4 text-left fw-bold">{{ $lesson->title }}</h1>
            <div class="description pe-5 lh-lg">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <img src="/img/lesson-image.png" class="img-fluid" alt="Lesson Image">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque temporibus aliquam autem sapiente deleniti eum, quisquam adipisci quos illum vel asperiores est? Corrupti, blanditiis atque nulla incidunt nostrum rem quo.</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="border p-4">
                <div class="row g-3">
                    <div class="col-6">Lesson No:</div>
                    <div class="col-6">{{ $lesson->id }}</div>
                    <div class="col-6">Lesson Status:</div>
                    <div class="col-6">{{ (!empty($lessonStatus)) ? 'Watched' : 'Pending' }}</div>
                    <div class="col-6">Lesson Date:</div>
                    <div class="col-6">{{ date('d-m-Y', strtotime($lesson->created_at)); }}</div>
                </div>
                @if(!empty($lessonStatus))
                    <div class="mt-4 d-grid">
                        <button class="btn btn-sm btn-warning not-allowed" disabled>Lesson Watched</button>
                    </div>
                @else
                    <form class="mt-4 d-grid" action="{{ route('watch') }}" method="POST">
                        @csrf
                        <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                        <button class="btn btn-sm btn-primary">Mark As Watched</button>
                    </form>
                @endif
            </div>
            <h5 class="mt-4 mb-3">Next Lessons</h5>
            @foreach ($nextLessons as $nextLesson)
                <div class="row mb-4 g-3">
                    <div class="col-4">
                        <img src="https://fakeimg.pl/120x100/?text=Lesson {{ $nextLesson->id }}" class="img-fluid" alt="Lesson Image">
                    </div>
                    <div class="col-8">
                        <p class="mb-2">{{ $nextLesson->title }}</p>
                        <a href="/lessons/{{ $nextLesson->id }}" class="text-primary">Play Lesson</a>
                    </div>
                </div>
            @endforeach
            <div class="d-flex">
                {!! $nextLessons->links() !!}
            </div>
        </div>

    </div>

</div>
@endsection