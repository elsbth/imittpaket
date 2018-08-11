<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Invite extends Model
{

    protected $fillable = [
        'token',
        'name',
        'email',
        'accepted',
        'accepted_at',
    ];

    public function hid() {
        return Hashids::connection('invite')->encode($this->id);
    }

    public static function decodeHid($hid) {
        $decoded = $hid ? Hashids::connection('invite')->decode($hid) : null;

        return is_array($decoded) && !empty($decoded) ? $decoded[0] : null;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'token';
    }

    /**
     * Many to many relationship to Role model.
     *
     * @return object
     */
    public function roles()
    {
        return $this->belongsToMany(Roles::class);
    }

    /**
     * Add a new invite and attach role(s) if applicable.
     *
     * @param object $request
     * @return object $invite
     */
    public function addNew($request)
    {
        $invite = $this->create($request->all());
        if($request->has('roles')) {
            $invite->roles()->attach($request->roles);
            return $invite->load('roles');
        }
        return $invite;
    }

    /**
     * Process an invited request to sign up/register
     * Find the invite by email, update accepted st and accepted boolean
     * Create a new User on the user model
     * Add applicable roles and return user object
     *
     * @param object $request
     * @return User $user
     */
    public function processInvited($request)
    {
        $invited = $this->with('roles')->where('email', $request->email)->first();
        if($invited) {
            $invited->update(['accpeted' => 1, 'accpeted_at' => \Carbon\Carbon::now()->toDateTimeString()]);
            $user = User::create([
                'name' => $invite->name,
                'email' => $invite->email,
                'password' => $request->password,
                'active' => 1,
            ]);
            if($invited->roles) {
                $user->roles()->attach($invited->roles());
            }
            return $user;
        }
        return abort('404', 'No invite was found');

    }
}
