<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Channel
 *
 * @property int $id
 * @property string $name
 * @property int|null $tv_group_id
 * @property int $number
 * @property int $sky_api_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TvShow[] $tvShows
 * @property-read int|null $tv_shows_count
 * @method static \Database\Factories\ChannelFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereSkyApiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereTvGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereUpdatedAt($value)
 */
	class Channel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TvGroup
 *
 * @property int $id
 * @property string $name
 * @property string|null $sub_tv_group_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TvGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TvGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TvGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|TvGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvGroup whereSubTvGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvGroup whereUpdatedAt($value)
 */
	class TvGroup extends \Eloquent {}
}

namespace App\Models{

	class TvShow extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TvShowDetail
 *
 * @property int $id
 * @property string $sky_api_uuid
 * @property string $title
 * @property string|null $description
 * @property string|null $genre
 * @property string|null $backdrop_url
 * @property string|null $cover_url
 * @property int|null $indexed_in_sitemap
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TvShow[] $tvShows
 * @property-read int|null $tv_shows_count
 * @method static \Database\Factories\TvShowDetailFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereBackdropUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereCoverUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereIndexedInSitemap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereSkyApiUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TvShowDetail whereUpdatedAt($value)
 */
	class TvShowDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

