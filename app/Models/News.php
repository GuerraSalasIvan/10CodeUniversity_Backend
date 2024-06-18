<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_news', 'event_id', 'news_id');
    }
}
