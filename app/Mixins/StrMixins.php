<?php

namespace App\Mixins;


class StrMixins
{
    // function name as macro name
    public function partNumber()
    {
        return function ($part){
            return 'AB-'.strtoupper($part);
        };

    }

    public function serialNumber()
    {
        return function ($part){
            return 'sn-'.strtolower($part);
        };

    }
}