<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class mst_data extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at'];
    protected $dates = ['deleted_at'];

    public function trDataCategory()
    {
        return $this->belongsTo('App\trDataCategory', 'category_id');
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }
    public function Userdel()
    {
        return $this->belongsTo(User::class, 'userdel')->withTrashed();
    }

    public function history()
    {
        return $this->hasMany('App\trDataHistori','data_id')->withTrashed();
    }
    public function filehistory()
    {
        return $this->hasMany('App\trFileHistori','data_id');
    }
    public function filesurat()
    {
        return $this->hasMany('App\trFile','data_id')->withTrashed();
    }public function filesuratonly()
    {
        return $this->hasMany('App\trFile','data_id');
    }

}
