<?php

namespace App\Http\Controllers;

use App\Models\User;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $lessonsWatched   = count($user->watched);
        $commentsWritten  = count($user->comments);

        $lessonAchievementsArray = [
            'First Lesson Watched',
            '5 Lessons Watched',
            '10 Lessons Watched',
            '25 Lessons Watched',
            '50 Lessons Watched'
        ];

        $commentAchievementsArray = [
            'First Comment Written',
            '3 Comments Written',
            '5 Comments Written',
            '10 Comment Written',
            '20 Comment Written'
        ];

        $badges = [
            'Beginner',
            'Intermediate',
            'Advanced',
            'Master'
        ];

        $lessonAchievements = match (true) {
            $lessonsWatched == 0  => [],
            $lessonsWatched <  5  => array_slice($lessonAchievementsArray, 0, 1),
            $lessonsWatched <  10 => array_slice($lessonAchievementsArray, 0, 2),
            $lessonsWatched <  25 => array_slice($lessonAchievementsArray, 0, 3),
            $lessonsWatched <  50 => array_slice($lessonAchievementsArray, 0, 4),
            $lessonsWatched >= 50 => array_slice($lessonAchievementsArray, 0, 5),
            default => array_slice($lessonAchievementsArray, 0, 1),
        };

        $commentAchievements = match (true) {
            $commentsWritten == 0  => [],
            $commentsWritten <  3  => array_slice($commentAchievementsArray, 0, 1),
            $commentsWritten <  5  => array_slice($commentAchievementsArray, 0, 2),
            $commentsWritten <  10 => array_slice($commentAchievementsArray, 0, 3),
            $commentsWritten <  20 => array_slice($commentAchievementsArray, 0, 4),
            $commentsWritten >= 20 => array_slice($commentAchievementsArray, 0, 5),
            default => array_slice($commentAchievementsArray, 0, 1),
        };

        $unlockedAchievements = array_merge($lessonAchievements, $commentAchievements);

        $nextAchievements = array_merge(
            array_diff($lessonAchievementsArray, $lessonAchievements),
            array_diff($commentAchievementsArray, $commentAchievements)
        );

        $totalAchievement  = count($unlockedAchievements);
        $remainAchievement = count($nextAchievements);

        $currentBadge = match (true) {
            $totalAchievement <  4  => $badges[0],
            $totalAchievement <  8  => $badges[1],
            $totalAchievement <  10 => $badges[2],
            $totalAchievement >= 10 => $badges[3],
            default => $badges[0],
        };

        $nextBadge = match ($currentBadge) {
            'Beginner' => $badges[1],
            'Intermediate' => $badges[2],
            'Advanced' => $badges[3],
            'Master' => "",
            default => $badges[1],
        };

        $remaingToUnlock = match (true) {
            $totalAchievement <= 3  => (4 - $totalAchievement),
            $totalAchievement <= 7  => (8 - $totalAchievement),
            $totalAchievement <= 9  => (10 - $totalAchievement),
            $totalAchievement == 10 => (0),
        };

        return view('achievements.index', compact('unlockedAchievements', 'nextAchievements', 'currentBadge', 'nextBadge', 'remaingToUnlock'));
    }
}
