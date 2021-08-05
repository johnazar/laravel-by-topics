<?php
namespace App\MyFacades;

use Illuminate\Support\Facades\Mail;

class PostCardSendingService
{
    private $country;
    private $width;
    private $height;
    public function __construct($country,$width,$height)
    {
        $this->country=$country;
        $this->width=$width;
        $this->height=$height;
     
    }
    public function hey($message, $email)
    {
        // Mail::raw($message , function($message)use ($email){
        //     $message->to($email);
        // });

        //mail out postcard through some service
        // $this->country;
        // $this->width;
        // $this->heigh;
        dd('Post card was sent with message: ('. $message.') to:'.$email);


    }

}