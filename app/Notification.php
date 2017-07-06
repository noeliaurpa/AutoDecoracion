<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message'
    ];


    public function scopeSearch($query, $message)
    {
    	return $query->where('message', 'LIKE', "%$message%");
    }
}
