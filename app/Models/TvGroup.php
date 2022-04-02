<?php

namespace App\Models;

use App\Classes\ValidTvTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class TvGroup extends Model
{
    use HasFactory;
    use HasSlug;
    public const DIGITALE_TERRESTRE = 'Digitale terrestre';

    public static function getGroupedTvGroups()
    {
        return self::select('name')
            ->addSelect(DB::raw('group_concat(sub_tv_group_name) as sub_tv_groups, group_concat(slug) as slugs'))
            ->distinct()
            ->groupBy('name')
            ->get();
    }

    public static function route(?string $tvGroupName = null, ?string $time = null)
    {
        $tvGroup = $tvGroupName ?? TvGroup::DIGITALE_TERRESTRE;

        return route('channels.index', [
            'tvGroup' => \Str::slug($tvGroup),
            'time' => $time ?? (\Request::route('time') ?? ValidTvTime::ON_AIR),
        ]);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'sub_tv_group_name'])
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

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }
}
