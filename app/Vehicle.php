<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'license_plate_or_detail', 'brand','model','observation', 
    ];


    public function scopeSearch($query, $license_plate_or_detail)
    {
    	return $query->where('license_plate_or_detail', 'LIKE', "%$license_plate_or_detail%");
    }

    public function scopeVehicle($query, $id)
    {
        return $query->where('id', 'LIKE', "%$id%");
    }

    public function client()
    {
        return $this->belongsTo('App\Customer');
    }
}
