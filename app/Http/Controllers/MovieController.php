<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Comment;
use App\Models\Director;
use App\Models\Movie;
use App\Services\MovieFilterService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    protected $movieFilterService;

    public function __construct(MovieFilterService $movieFilterService)
    {
        $this->movieFilterService = $movieFilterService;
    }

    public function index()
    {
        $movies = Movie::paginate(25);
        $actors = Actor::all();
        $directors = Director::all();

        return view('movies.index', [
            'movies' => $movies,
            'actors' => $actors,
            'directors' => $directors,
        ]);
    }

    public function filter(Request $request)
    {
        $actorsAll = Actor::all();
        $directorsAll = Director::all();
        $actors = $request->input('actors');
        $director = $request->input('director_id');
        $releaseBefore = $request->input('release_before');
        $releaseAfter = $request->input('release_after');
        $ratingMin = $request->input('rating_min');
        $ratingMax = $request->input('rating_max');
        $sortBy = $request->input('sort_by', 'release');
        $sortOrder = $request->input('sort_order', 'asc');

        $filteredMovies = $this->movieFilterService->filterMovies($actors, $director, $releaseBefore,
            $releaseAfter, $ratingMin, $ratingMax, $sortBy, $sortOrder);

        return view('movies.filtered', [
            'movies' => $filteredMovies,
            'actors' => $actorsAll,
            'directors' => $directorsAll
        ]);
    }
    public function show(Movie $movie)
    {
        $actors = Actor::all();
        $comments = Comment::with('user')->latest()->get();
        return view('movies.show', [
            'movie' => $movie,
            'comments' => $comments,
            'actors' => $actors,

        ]);
    }
    public function comment(Request $request)
    {
        $data = $request->validate([
            'movie_id' => 'required',
            'message' => 'required|string|min:5'
        ]);
        $data['user_id'] = auth()->user()->id;
        Comment::create($data);
        return redirect(route('movies.show', $data['movie_id']));
    }

}
