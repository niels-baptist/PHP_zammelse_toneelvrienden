<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Chair
 *
 * @property int $id
 * @property int $hall_id
 * @property int $floor
 * @property int $chairNumber
 * @property int $active
 * @property int $wheelchairAccessible
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Hall $halls
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @property-read int|null $ticket_count
 * @method static \Illuminate\Database\Eloquent\Builder|Chair newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chair newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chair query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chair whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chair whereChairNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chair whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chair whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chair whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chair whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chair whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chair whereWheelchairAccessible($value)
 */
	class Chair extends \Eloquent {}
}

namespace App{
/**
 * App\Hall
 *
 * @property int $id
 * @property string $name
 * @property int $capacity
 * @property string $address
 * @property string $place
 * @property string $postalCode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Chair[] $chair
 * @property-read int|null $chair_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Play[] $play
 * @property-read int|null $play_count
 * @method static \Illuminate\Database\Eloquent\Builder|Hall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereUpdatedAt($value)
 */
	class Hall extends \Eloquent {}
}

namespace App{
/**
 * App\Job
 *
 * @property int $id
 * @property string $name
 * @property string|null $job
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PlayRole[] $playRole
 * @property-read int|null $play_role_count
 * @method static \Illuminate\Database\Eloquent\Builder|Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereUpdatedAt($value)
 */
	class Job extends \Eloquent {}
}

namespace App{
/**
 * App\Mail
 *
 * @property int $id
 * @property string $content
 * @property string $subject
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Mail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mail whereUpdatedAt($value)
 */
	class Mail extends \Eloquent {}
}

namespace App{
/**
 * App\Performance
 *
 * @property-read \App\Hall $halls
 * @property-read \App\Play $play
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @property-read int|null $ticket_count
 * @method static \Illuminate\Database\Eloquent\Builder|Performance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Performance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Performance query()
 */
	class Performance extends \Eloquent {}
}

namespace App{
/**
 * App\Play
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Performance[] $performances
 * @property-read int|null $performance_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PlayRole[] $playRole
 * @property-read int|null $play_role_count
 * @method static \Illuminate\Database\Eloquent\Builder|Play newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Play newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Play query()
 */
	class Play extends \Eloquent {}
}

namespace App{
/**
 * App\PlayRole
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $play_id
 * @property int $role_id
 * @property string|null $character
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Play $play
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole whereCharacter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole wherePlayId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlayRole whereUserId($value)
 */
	class PlayRole extends \Eloquent {}
}

namespace App{
/**
 * App\Reservation
 *
 * @property int $id
 * @property int $performance_id
 * @property string $reservationDate
 * @property int $paymentByTransfer
 * @property string $email
 * @property string $firstName
 * @property string $surname
 * @property string $telephone
 * @property string $address
 * @property string $place
 * @property string $postalCode
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Play $play
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ticket[] $tickets
 * @property-read int|null $ticket_count
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePaymentByTransfer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePerformanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereReservationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reservation whereUpdatedAt($value)
 */
	class Reservation extends \Eloquent {}
}

namespace App{
/**
 * App\Ticket
 *
 * @property-read \App\Chair $chair
 * @property-read \App\Performance $performances
 * @property-read \App\Reservation $reservations
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 */
	class Ticket extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $telephone
 * @property string $firstName
 * @property string $surname
 * @property string $address
 * @property string $place
 * @property string $postalCode
 * @property string $sex
 * @property int $active
 * @property int $admin
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PlayRole[] $playrole
 * @property-read int|null $playrole_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

