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
    'license_plate_or_detail','brand','model', 'number', 'nameClient','total', 'subtotal', 'iv', 'observation', 'state','Client_or_Provider'
    ];

    public function scopeSearch($query, $nameClient)
    {
        return $query->where('nameClient', 'LIKE', "%$nameClient%");
    }
    
    public function client()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
