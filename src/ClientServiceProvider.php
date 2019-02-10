<?php
/**
 * Created by PhpStorm.
 * User: Santosh
 * Date: 2/10/2019
 * Time: 10:13 AM
 */

namespace Santosh\Client;


use Illuminate\Support\ServiceProvider;
use Santosh\Client\Facades\Client;

class ClientServiceProvider extends ServiceProvider
{
    public function boot()
    {
        
    }

    public function register()
    {
        $this->app->bind(HttpClient::class, function(){
            return new HttpClient();
        });

        $this->app->alias(HttpClient::class,'client');
    }
}