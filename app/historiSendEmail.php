<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historiSendEmail extends Model
{
    protected $guarded = ['id', 'created_at'];

    public function usw()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
}
