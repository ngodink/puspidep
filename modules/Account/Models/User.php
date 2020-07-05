<?php

namespace Modules\Account\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

use Modules\Account\Models\Traits\UserTrait;
use Modules\Account\Models\Traits\UserRBACTrait;
use Modules\Account\Models\Repositories\UserRepository;

use Modules\Web\Models\Traits\UserTrait as UserWebTrait;

class User extends Authenticatable
{
    use Notifiable,
        // HasApiTokens,
        SoftDeletes,
        Userstamps,
        UserTrait,
        UserRBACTrait,
        UserRepository,
        UserWebTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'username', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [];

    /**
     * The attributes that define value is a instance of carbon.
     */
    protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    /**
     * The relations to eager load on every query.
     */
    public $with = [
        'profile', 'email', 'phone'
    ];

    /**
     * The accessors to append to the model's array form.
     */
    protected $appends = [
        'full_username'
    ];

    /**
     * Find the user instance for the given username.
     */
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Retrieve the model for a bound value.
     */
    public function resolveRouteBinding($value, $field = NULL)
    {
        return $this->withTrashed()->where($this->getRouteKeyName(), $value)->first();
    }

    /**
     * Route notifications for the mail channel.
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email->address;
    }

    /**
     * Generate password.
     */
    public static function generatePassword ($length = 6) {
        return substr(str_shuffle('123456789ABCDEF'), 0, $length);
    }

    /**
     * Get username attributes.
     */
    public function getFullUsernameAttribute () {
        return $this->username.'@'.env('APP_DOMAIN');
    }

    /**
     * This has many logs.
     */
    public function logs () {
        return $this->hasMany(UserLog::class);
    }

    /**
     * This log.
     */
    public function log ($value) {
        return $this->logs()->create(['log' => $value]);
    }

    /**
     * This has one email.
     */
    public function email () {
        return $this->hasOne(UserEmail::class)->withDefault();
    }

    /**
     * This has many phone.
     */
    public function phone () {
        return $this->hasOne(UserPhone::class)->withDefault();
    }

    /**
     * This has one profile.
     */
    public function profile () {
        return $this->hasOne(UserProfile::class, 'user_id')->withDefault();
    }

    /**
     * This has one broker.
     */
    public function broker () {
        return $this->hasOne(UserPasswordReset::class);
    }

    /**
     * This has one father.
     */
    public function father () {
        return $this->hasOneThrough(User::class, UserFather::class, 'user_id', 'id', 'id', 'father_id')->withDefault();
    }

    /**
     * This has one mother.
     */
    public function mother () {
        return $this->hasOneThrough(User::class, UserMother::class, 'user_id', 'id', 'id', 'mother_id')->withDefault();
    }

    /**
     * This has one foster.
     */
    public function foster () {
        return $this->hasOneThrough(User::class, UserFoster::class, 'user_id', 'id', 'id', 'foster_id')->withDefault();
    }

    /**
     * This has one address.
     */
    public function address () {
        return $this->hasOne(UserAddress::class, 'user_id')->withDefault();
    }

    /**
     * This has many studies.
     */
    public function studies () {
        return $this->hasMany(UserStudy::class, 'user_id');
    }

    /**
     * This has many achievements.
     */
    public function achievements () {
        return $this->hasMany(UserAchievement::class, 'user_id');
    }

    /**
     * This has many appreciations.
     */
    public function appreciations () {
        return $this->hasMany(UserAppreciation::class, 'user_id');
    }

    /**
     * This has many organizations.
     */
    public function organizations () {
        return $this->hasMany(UserOrganization::class, 'user_id');
    }

    /**
     * This has many disabilities.
     */
    public function disabilities () {
        return $this->belongsToMany(\App\Models\References\Disability::class, 'user_disabilities', 'user_id', 'disability_id');
    }

    /**
     * This has many roles.
     */
    public function roles () {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    /**
     * This has many permissions.
     */
    public function permissions () {
        return $this->belongsToMany(Permission::class, 'user_permissions', 'user_id', 'permission_id');
    }

    /**
     * Scope where roles is admin.
     */
    public function scopeWhereAdmin () {
        return $this->whereHas('roles', function ($q) {
            return $q->whereNotIn('id', [5]);
        });
    }
}