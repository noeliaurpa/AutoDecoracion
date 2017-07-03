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
        'invoice_id', 'article_id', 'quantity','price', 'total'
    ];
}
