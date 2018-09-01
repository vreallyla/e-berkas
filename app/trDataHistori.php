<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class trDataHistori extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at'];
    protected $dates = ['deleted_at'];

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }

    public function cate()
    {
        return $this->belongsTo('App\trDataCategory', 'category_id');
    }

}
