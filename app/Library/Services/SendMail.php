<?php

namespace App\Library\Services;
use App\Token;
use App\User;
use Crypt;
use Illuminate\Support\Facades\Hash;
use Mail;

class SendMail {
   
    private $codeVerify,$email;

    public function setParamMail($em = null,$code = null) {

         $this->codeVerify = $code;
         $this->email = $em;
    }

    public function inviaMail()
    {
        $title = 'attiva l account';
        $content = 'benvenuto ';

        $data = [
        'title' => $title,
        'content' => $content,
        'email' => $this->email,
        'code' => $this->codeVerify
        ];

        Mail::send('email.sendMail',$data, function ($message)
        {

            $message->from('me@gmail.com', 'Christian Nwamba');
            $message->to('chrisn@scotch.io');

        });

        return ['message' => 'inviato'];
    }


}

?>