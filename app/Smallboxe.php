<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smallboxe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
   'article_id','observation' => 'null', 
   ];


   public function scopeSearch($query, $name)
   {
   	return $query->where('name', 'LIKE', "%$name%");
   }
}
