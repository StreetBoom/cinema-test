<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rateMovie(Request $request, Movie $movie)
    {
        $user = $request->user();
        $rating = $request->input('rating');
        $movieRating = Rating::where('movie_id', $movie->id)
            ->where('user_id', $user->id)
            ->first();
        if ($movieRating) {
            $movieRating->rating = $rating;
            $movieRating->save();
        } else {
            $movieRating = new Rating([
                'movie_id' => $movie->id,
                'user_id' => $user->id,
                'rating' => $rating,
            ]);
            $movieRating->save();
        }
        $movie->calculateRating();
        return redirect(route('movies.show', $movieRating['movie_id']));
    }
}
