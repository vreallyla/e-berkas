<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trDataCategory extends Model
{
    protected $guarded = ['id', 'created_at'];
    public function mstdata()
    {
        return $this->hasMany('App\mst_data','category_id')->withTrashed();
    }
    public function jobdescc()
    {
        return $this->belongsTo(trDataJobDesc::class,'job_id');
    }
}
