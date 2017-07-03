<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoicesreport extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vehicle_id', 'number', 'client_id','total', 'subtotal', 'iv', 'observation'
    ];
}
