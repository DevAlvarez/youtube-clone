<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

//use Illuminate\Database\Eloquent\Model;


class Channel extends Model implements HasMedia
//class Channel extends Model 
{

    use InteractsWithMedia;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        if ($this->media->first()) {
            return $this->media->first()->getFullUrl('thumb');
        }

        return null;
    }

    /**
     * 
     * Check if a user is authorized to edit this model instance
     * 
     * @return boolean
     * 
     */
    public function editable()
    {
        if (! auth()-> check()) return false;

        return $this->user_id === auth()->user()->id;
    }

    /**
     * Register the media conversions.
     * 
     * @return null
     * 
     */


    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(100)
              ->height(100);
            //   ->sharpen(10);
    }

    /**
     * A channel has many subscriptions
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }




}