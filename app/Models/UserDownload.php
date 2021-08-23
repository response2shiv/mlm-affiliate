<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDownload extends Model
{

    protected $fillable = ['user_id', 'performed'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
