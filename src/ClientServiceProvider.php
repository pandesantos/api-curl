<?php


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