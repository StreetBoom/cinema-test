<?php

namespace Database\Factories;

use App\Models\Actor;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return Factory|MovieFactory
     */
//    public function configure()
//    {
//        return $this->afterCreating(function (Movie $movie) {
//            $movie->actors()->attach(Actor::factory()->count(2)->create());
//        });
//    }


    public function definition(): array
    {
        return [
            'name' => fake()->text(15),
            'description' => fake()->text(50),
            'release' => Carbon::today()->subDays(rand(1, 30)),
            'rating' => rand(1, 10),
            'director_id' => rand(1, 15),


        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Movie $movie) {
//            $movie->actors()->attach(Actor::factory()->count(2)->create());
            for ($i = 0; $i < 5; $i++) {
                $actors = Actor::all();
                $shuffledActors = $actors->shuffle();
                $numberOfActors = rand(1, $actors->count());
                $selectedActors = $shuffledActors->take($numberOfActors)->pluck('id')->toArray();

            }
            $movie->actors()->attach($selectedActors);
        });
    }
}
