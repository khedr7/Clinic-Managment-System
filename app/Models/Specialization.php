<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslations;

    const PATH = 'specializations';

    protected $fillable = [
        'title', 'details',
    ];

    protected $translatable = [
        'title', 'details',
    ];

    protected $casts = [
        'title'   => 'string',
        'details' => 'string',
    ];

    public function getImageAttribute()
    {
        if ($this->getMedia('image')->first())
            return $this->getMedia('image')->first()->getFullUrl();
        return null;
    }

    protected $appends = ['image'];

    public function doctors()
    {
        return $this->hasMany(User::class);
    }
}
