<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'workNumber', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** 与审核 一对多关系 */
    public function verify()
    {
        return $this->hasMany('App\Verify','verify_by');
    }

    /** 与借款 一对多关系 */
    public function loan()
    {
        return $this->hasMany('App\Loan');
    }
}
