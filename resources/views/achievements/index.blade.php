@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row g-5 my-4 text-left">
        
        <div class="col-md-4">
            <h5 class="mb-4">Unlocked Achievements</h5>
            @if(!empty($unlockedAchievements))
                @foreach ($unlockedAchievements as $achievement)
                    <p><i class="fa fa-award me-2 text-success"></i> {{ $achievement }}</p>
                @endforeach
            @else
                <p class="text-muted">No Achievement Unlocked</p>
            @endif
        </div>

        <div class="col-md-4">
            <h5 class="mb-4">Next Achievements</h5>
            @foreach ($nextAchievements as $achievement)
                <p><i class="fa fa-award me-2 text-danger"></i> {{ $achievement }}</p>
            @endforeach
        </div>

        <div class="col-md-4">
            <h5 class="mb-4">Current Badge</h5>
            <h2 class="mt-3">
                <i class="fa fa-medal me-2 text-warning"></i> {{ $currentBadge }}
            </h2>
            @if(!empty($nextBadge))
                <h5 class="mt-5 mb-4">Next Badge <small class="fs-6 text-muted">({{ ($remaingToUnlock != 0) ? $remaingToUnlock . ' Achievements Remaining' : '' }})</small></h5>
                <h2 class="mt-3">
                    <i class="fa fa-medal me-2 text-warning"></i> {{ $nextBadge }}
                </h2>
                <p></p>
            @endif
        </div>

    </div>
</div>
@endsection
