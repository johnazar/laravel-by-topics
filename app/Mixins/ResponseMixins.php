<?php

namespace App\Mixins;


class ResponseMixins
{
    // function name as macro name
    public function errorJson()
    {
        return function($message){
            return [
                'message'=>$message,
                'errorCode'=>'123'
            ];
        };

    }


}