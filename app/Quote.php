<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    /*
	Le decimos a que base de datos va
	*/
    protected $table='quotes';

    /*
	Decimos que parametros lleva
    */
    protected $fillable = [
    	'title', 'start', 'end', 'color'
    ];
}
