<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class trFile extends Model
{
    use SoftDeletes;
    protected $guarded = ['id', 'created_at'];
    protected $dates = ['deleted_at'];

    public function fileHistory(){
        return $this->hasMany(trFileHistori::class);
    }
}
