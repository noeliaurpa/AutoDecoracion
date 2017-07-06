<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventorie extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
   'article_id','observation' => 'null', 
   ];


   public function scopeSearch($query, $article_id)
   {
   	return $query->where('article_id', 'LIKE', "%$article_id%");
   }

   public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
