<?php

namespace App\Library\Services;
use App\Token;
use App\User;
use Crypt;
use Illuminate\Support\Facades\Hash;

class DemoOne
{

    private $data;

    public function utenteRegistrazione(array $data)
    {
        $this->data = $data;
        $this->data['email'];
        $this->data['name'];
        $password = Hash::make($this->data['pwd']);

        $user = new User;
        $user->name = $this->data['name'];
        $user->email = $this->data['email'];
        $password = Hash::make($this->data['pwd']);
        $user->password = $password;
        $endTime = date("Y-m-d H:i",time() + 120);
        $user->data = $endTime;
        $user->save();

        $toke = new Token;
        $code = $this->data['code'];
        $toke->code = $code;
        
        $user->token()->save($toke);
        return true;
    }

    public function orario()
    {
        date_default_timezone_set('Europe/Rome');
        $user = User::where('email','=',$this->data['email'])->firstOrFail();
        $endTime = date("Y-m-d H:i",time() + 120);
        $user->data = $endTime;
        $user->push();

        $code = '7S86S3487H';
        $toke = Token::where('user_id', '=' ,$user->id)->firstOrFail();
        $encrypted = Crypt::encrypt($code);
        $toke->code = $encrypted;
        $toke->push();
       
        return true;
    }
}

?>