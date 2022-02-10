@extends('layouts.app')

@section('content')
<div class="container">

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

    <h1 class="mt-3 mb-5 text-center fs-2 text-uppercase fw-bold">Comments</h1>

    <div class="row g-5 justify-content-center">

        <div class="col-md-6">

            @if(!$comments->isEmpty())
                @foreach ($comments as $comment)
                    <div class="mb-4 border p-4">
                        <small class="text-muted">{{ $comment->user->name }}</small>
                        <p class="mt-2 mb-0">{{ $comment->body }}</p>
                    </div>
                @endforeach
            @else
                <h5 class="text-center text-muted fw-light my-5">No Comment Found</h5>
            @endif

            <form class="my-4" action="{{ route('comment') }}" method="POST">
                @csrf
                <div class="col-12">
                    <textarea name="comment" class="form-control" cols="30" rows="6" placeholder="Enter Your Comment"></textarea>
                </div>
                <div class="d-grid">
                    <button class="mt-2 btn btn-primary">Submit Comment</button>
                </div>
            </form>

        </div>

    </div>
</div>
@endsection