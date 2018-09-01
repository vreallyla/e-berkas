<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at'];
//    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\status', 'role_id');
    }

    public function jobs()
    {
        return $this->belongsTo(trDataJobDesc::class, 'job_id');
    }

    public function posisitions()
    {
        return $this->belongsTo(trDataPosisition::class, 'posisition_id');
    }
    public function mstdata()
    {
        return $this->hasMany('App\mst_data','category_id')->withTrashed();
    }

}
