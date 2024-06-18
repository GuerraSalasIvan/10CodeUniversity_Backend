<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        "title",
        "description",
        "organizator",
        "available_at",
        "finish_at",
        "ubication_id",
        "code",
        "capacity"
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];


    public function ubications(): BelongsTo
    {
        return $this->belongsTo(Ubication::class, 'ubication_id', 'id');
    }

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'event_news', 'news_id', 'event_id');
    }
}
