<?php

namespace App\Services;

use App\Models\Movie;

class MovieFilterService
{

    public function filterMovies($actors, $director, $releaseBefore, $releaseAfter, $ratingMin, $ratingMax, $sortBy, $sortOrder)
    {
        $movies = Movie::query();

        if ($actors) {
            $movies->whereHas('actors', function ($query) use ($actors) {
                $query->whereIn('id', $actors);
            });
        }
        if ($director) {
            $movies->whereHas('director', function ($query) use ($director) {
                $query->where('id', $director);
            });
        }
        if ($releaseBefore) {
            $movies->where('release', '<=', $releaseBefore);
        }
        if ($releaseAfter) {
            $movies->where('release', '>=', $releaseAfter);
        }
        if ($ratingMin) {
            $movies->where('rating', '>=', $ratingMin);
        }
        if ($ratingMax) {
            $movies->where('rating', '<=', $ratingMax);
        }
        $movies->orderBy($sortBy, $sortOrder);
        $filteredMovies = $movies->paginate(25);

        return $filteredMovies;
    }

}
