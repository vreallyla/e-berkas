<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trFileHistori extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function files()
    {
        return $this->belongsTo(trFile::class, 'file_id')->withTrashed();
    }
}
