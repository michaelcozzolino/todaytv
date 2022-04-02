<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class TvShowDetail extends Model implements Sitemapable
{
    use HasFactory;
    use HasSlug;
    protected $fillable = ['api_uuid', 'title', 'description', 'genre', 'cover_url', 'indexed_in_sitemap'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function tvShows()
    {
        return $this->hasMany(TvShow::class);
    }

    public function hasPicture()
    {
        return isset($this->cover_url);
    }

    public function route()
    {
        return route('tv-show-details.show', ['tvShowDetail' => $this->slug]);
    }

    public function toSitemapTag(): Url|string|array
    {
        return $this->route();
    }
}
