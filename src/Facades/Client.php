<?php
/**
 * Created by PhpStorm.
 * User: Santosh
 * Date: 2/10/2019
 * Time: 10:16 AM
 */

namespace Santosh\Client\Facades;


use Illuminate\Support\Facades\Facade;

class Client extends Facade
{
    protected static function getFacadeAccessor()
    {
      return 'client';
    }
}