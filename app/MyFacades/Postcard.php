<?php
namespace App\MyFacades;

class Postcard
{
    public static function resolveFacade($name)
    {
        // return app()[$name];
        return app()->make($name);
    }
    public static function __callStatic($method, $arguments)
    {
        return (self::resolveFacade('Postcard'))->$method(...$arguments);
        
        
    }

}