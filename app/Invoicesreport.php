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

    public function client()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
