<?php
//app/Providers/MessageServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Message;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    protected $defer = true;
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Message',
        function(){ return new Message(); });
    }

    public function provides()
    {
        return ['App\Helpers\Message'];
    }
}
