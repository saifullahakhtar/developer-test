@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="mt-3 mb-5 text-center fs-2 text-uppercase fw-bold">Featured Playlists</h1>

    <div class="row g-5">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header p-0">
                    <img src="//fakeimg.pl/640x340/?text=Photography Lessons" class="img-fluid" alt="Course Image">
                </div>
                <div class="card-body d-flex justify-content-between">
                    <a href="/course/photography" class="btn btn-primary">View Playlist</a>
                    <button class="btn btn-white" disabled>Total Lessons: 20</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header p-0">
                    <img src="//fakeimg.pl/640x340/?text=Coming Soon" class="img-fluid" alt="Course Image">
                </div>
                <div class="card-body d-flex justify-content-between">
                    <button class="btn btn-primary" disabled>View Playlist</button>
                    <button class="btn btn-white" disabled>Coming Soon</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
