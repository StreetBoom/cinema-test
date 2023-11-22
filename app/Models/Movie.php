<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
    public function director(): BelongsTo
    {
        return $this->belongsTo(Director::class);
    }
    public function calculateRating()
    {

        $ratings = $this->ratings;
        $totalRating = $ratings->sum('rating');
        $averageRating = $totalRating / $ratings->count();
        $this->rating = $averageRating;
        $this->save();
    }



}
