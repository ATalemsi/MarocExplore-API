<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $itinerary_id
 * @property int $user_id
 * @property string $name
 * @property string $accommodation
 * @property string|null $places_to_visit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Itinerary|null $itiniraire
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\DestinationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Destination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Destination newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Destination query()
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereAccommodation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereItineraryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination wherePlacesToVisit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Destination whereUserId($value)
 */
	class Destination extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string $category
 * @property int $duration
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Destination> $destinations
 * @property-read int|null $destinations_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\ItineraryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary query()
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Itinerary whereUserId($value)
 */
	class Itinerary extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Destination> $destinations
 * @property-read int|null $destinations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Itinerary> $itiniraires
 * @property-read int|null $itiniraires_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
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

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\Itinerary|null $itinerary
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Visit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit query()
 */
	class Visit extends \Eloquent {}
}

