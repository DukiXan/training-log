<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
	/**
    * Get the owner of the exercise
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
