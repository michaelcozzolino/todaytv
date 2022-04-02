<?php

namespace App\Models;

use App\Classes\TvShowsManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Channel extends Model implements Sitemapable
{
    use HasFactory;
    use HasSlug;
    use HasEagerLimit;

    public function scopeUseAPI(Builder $builder, string $channelProvider = TvShowsManager::RAI_PROVIDER): Builder
    {
        $operator = $channelProvider === TvShowsManager::RAI_PROVIDER ? 'like' : 'not like';

        return $builder->where('api_id', $operator, '%' . TvShowsManager::RAI_PROVIDER . '%')->select('api_id');
    }

    public function tvShows()
    {
        return $this->hasMany(TvShow::class);
    }

    public function tvGroup()
    {
        return $this->belongsTo(TvGroup::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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

    public function route()
    {
        return route('channels.show', ['channel' => $this->slug]);
    }

    public static function getTvShowsByTime(TvGroup $tvGroup, string $time): Collection|array
    {
        return Channel::with([
            'tvShows' => function (Builder|HasMany $builder) use ($time) {
                return $builder
                    ->time($time)
                    ->latest('starting_at')
                    ->take(3);
            },
        ])
            ->where('tv_group_id', $tvGroup->id)
            ->whereHas('tvShows', function (Builder|HasMany $query) use ($time) {
                return $query->time($time);
            })
            ->get();
    }

    public function toSitemapTag(): Url|string|array
    {
        return $this->route();
    }
}
