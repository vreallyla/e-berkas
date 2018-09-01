<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trDataJobDesc extends Model
{
    protected $guarded=['id','created_at'];

    public function DataCatagories(){
        return $this->hasMany(trDataCategory::class,'job_id');
    }
    public function ps(){
        return $this->hasMany('App\trDataPosisition','job_id','id');
    }
}
