# api-curl
This is simple package built for laravel framework to make easy api calls. It uses Client URL Library (cURL) at its core.

 
## Requirements

* laravel ^5.0

## Installation

Require this package in your composer.json and update composer.

    composer require santosh/client
    

After updating composer, add the ServiceProvider to the providers array in config/app.php

    Santosh\Client\ClientServiceProvider::class,

And Add this to your facades:

    'Client' => Santosh\Client\Facades\Client::class,

## use

    $endPoint = 'http://www.yoururl.com';
    
    $headers = [
          'username' => 'santosh',
          'password' => '******'
    ];
    
    $client = Client::setUp($endPoint, $headers);  // $headers is optional

    
    
    $payload = [
        'key_1' => 'value_1',
        'key_2' => 'value_2'
    ];
    
    // sending request [GET]
    $client = Client::setUp($endPoint, $headers)
                    ->sendRequest($payload);
    
    
     //sending request [POST], pass second parameter 1 as shown
     
     $client = Client::setUp($endPoint, $headers)
                        ->sendRequest($payload, 1);
                        
    // if you want ssl verification to be false, pass third parameter false in sendRequest() method
    
    $client = Client::setUp($endPoint, $headers)
                            ->sendRequest($payload, 1, false);
                            
    // at last result can be retrived using jsonResponse() method
    
    $client = Client::setUp($endPoint, $headers)
                                ->sendRequest($payload, 1, false);
                                ->getResponse();
                                
    // getResponse() returns object by default,  if you want an associative array instead of an object pass true in getResponse() method
                            
    $client = Client::setUp($endPoint, $headers)
                                  ->sendRequest($payload, 1, false);
                                  ->getResponse(true);  
                                  
