<?php 
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

class FriendFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'password' => 'required',
            'email' => 'required|email',
            //'age' => 'required|integer|max:60'
        ];
    }

    public function authorize()
    {
        // Only allow logged in users
        // return \Auth::check();
        // Allows all users in
        if(strlen($this->email) <= 6)
            return false;
        else 
            return true;
    }

    // OPTIONAL OVERRIDE
    public function forbiddenResponse()
    {
        // Optionally, send a custom response on authorize failure 
        // (default is to just redirect to initial page with errors)
        // 
        // Can return a response, a view, a redirect, or whatever else
        return new Response('Forbidden', 403);
    }

    // OPTIONAL OVERRIDE
    public function response()
    {
        // If you want to customize what happens on a failed validation,
        // override this method.
        // See what it does natively here: 
        // https://github.com/laravel/framework/blob/master/src/Illuminate/Foundation/Http/FormRequest.php
    }
}