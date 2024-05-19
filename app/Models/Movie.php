<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
            'title',
            'viewing_date',
            'seen_status',
            'id_movie'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
