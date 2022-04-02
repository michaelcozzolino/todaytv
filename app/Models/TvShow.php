<?php

namespace App\Models;

/**
 * App\Models\TvShow.
 *
 * @property int $id
 * @property int $channel_id
 * @property int $tv_show_detail_id
 * @property \Illuminate\Support\Carbon $starting_at
 * @property \Illuminate\Support\Carbon $ending_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Channel $channel
 * @property-read \App\Models\TvShowDetail $detail
 * @method static \Database\Factories\TvShowFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow primeTime()
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow query()
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow whereEndingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow whereStartingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow whereTvShowDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShow whereUpdatedAt($value)
 */

use App\Classes\ValidTvTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class TvShow extends Model
{
    use HasFactory;
    use HasEagerLimit;

    protected $fillable = ['starting_at', 'ending_at', 'channel_id', 'duration'];
    protected $with = ['detail'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'starting_at' => 'datetime',
        'ending_at' => 'datetime',
    ];

    protected static function booted()
    {
        parent::booted();

        static::addGlobalScope('today', function (Builder $builder) {
            return $builder->whereDate('starting_at', Carbon::today()->toDateString())->orderBy('starting_at');
        });
    }

    public function detail()
    {
        return $this->belongsTo(TvShowDetail::class, 'tv_show_detail_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopePrimeTime(Builder $builder)
    {
        return $builder->whereBetween(DB::raw('time(starting_at)'), ['20:29:00', '22:59:00']);
    }

    public function scopeSecondNight(Builder $builder)
    {
        return $builder->whereBetween(DB::raw('time(starting_at)'), ['23:00:00', '23:59:00']);
    }

    /**
     * Return the on air tv shows query, by adding an offset to the current time in order to match at least one tv show.
     * TODO: maybe it can be improved.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeOnAir(Builder $builder): Builder
    {
        return $builder->whereTime(
            'starting_at',
            '<=',
            Carbon::now()
                ->addMinutes(30)
                ->toTimeString(),
        );
    }

    public function scopeTime(Builder $builder, string $time)
    {
        switch ($time) {
            case ValidTvTime::ON_AIR:
                $builder = $builder->onAir();
                break;
            case ValidTvTime::PRIME_TIME:
                $builder = $builder->primeTime();
                break;
            case ValidTvTime::SECOND_NIGHT:
                $builder = $builder->secondNight();
                break;
        }

        return $builder;
    }

    public function scopeOld(Builder $builder)
    {
        return $builder->where('ending_at', '<=', Carbon::now()->subDays(2));
    }

    /**
     * Get the percentage of the passed amount of time since the begin of the tv show.
     *
     * @return int
     */
    public function getLiveTimeDurationPercentage(): int
    {
        $consumedMinutes = Carbon::now()->diffInMinutes($this->starting_at);

        return (int) (($consumedMinutes * 100) / $this->duration);
    }

    public function isLive(): bool
    {
        $now = Carbon::now();

        return $now->greaterThanOrEqualTo($this->starting_at) && $now->lessThanOrEqualTo($this->ending_at);
    }
}
