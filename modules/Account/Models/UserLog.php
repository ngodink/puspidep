<?php

namespace Modules\Account\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'user_logs';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'log'
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'user_id'
    ];

    /**
     * The attributes that define value is a instance of carbon.
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [];

    /**
     * This belongs to user.
     */
    public function user () {
        return $this->belongsTo(User::class);
    }
}
