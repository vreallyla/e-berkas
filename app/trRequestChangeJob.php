<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trRequestChangeJob extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'admin_id');

    }

    public function oldjob()
    {
        return $this->belongsTo('App\trDataJobDesc', 'job_id');
    }

    public function oldposisition()
    {
        return $this->belongsTo('App\trDataPosisition', 'posisition_id');
    }

    public function job()
    {
        return $this->belongsTo(trDataJobDesc::class, 'changejob_id');
    }

    public function posisition()
    {
        return $this->belongsTo(trDataPosisition::class, 'changeposisition_id');
    }

}
