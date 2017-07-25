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
   'article_id','nameArticle', 'observation', 
   ];


   public function scopeSearch($query, $nameArticle)
   {
   	return $query->where('nameArticle', 'LIKE', "%$nameArticle%");
   }

   public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
