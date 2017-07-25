<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoicesarticle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'codeArticle','nameArticle', 'quantity','price', 'total'
    ];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
