<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Articoli;
use App\Token;
use App;
use App\Library\Services\FooInterface;
use App\Library\Services\Worker;
use Auth;
use Hash;
use Session;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use DB;
use App\Http\Requests\FriendFormRequest;

class DavideController extends Controller {

    public function __construct()
    {
        //$this->middleware('amm')->except('richiesta'); 
    }

    public function authenticate(Request $request)
    {
        // prende dalla richiesta le credenziali di accesso
        $credentials = $request->only('email', 'password');

        try {
            // verifica le credenziali...
            if (!$token = JWTAuth::attempt($credentials)) {

            	// qualcosa è andato storto nella verifica delle credenziali
                return response()->json(['error' => 'invalid_credentials'], 401);

            }
        } catch (JWTException $e) {

            // qualcosa è andato storto in fase di codifica del token
            return response()->json(['error' => 'could_not_create_token'], 500);

        }

        // ... se tutto va bene il token viene rilasciato!
        return response()->json(compact('token'));
    }
    
    public function richiesta(FriendFormRequest $req)
    {
        if($req->isMethod('post')) {
             
             $email = $req->input('email');
             $pwd = $req->input('password');

             $data = ['email' => $email, 'password' => $pwd];
             if(auth()->attempt($data,true)) {
               
                Session::start();
                Session::put('user',true);
                Session::put('userEmail',auth()->user()->email); 
                Session::save();
                return redirect()->route('ammDavide');
                
                /*
                $userid = (Auth::check()) ? Auth::user()->id : false;
                $userRoleName = User::find($userid)->roles;
                $user = User::find($userid);
                */

                /*
                $a = [];
                $a[]['dati'] = [
        
                    'user' => $user,
                    'role' => $userRoleName,

                ];
                */

                return response()->json($a);
                

             }else {
           
                 return back()->withInput();
                 
             }

        }else {
            
            /*
            $user = User::All();
            foreach ($user as $value) {
                echo $value->name.'<br>';
                if(sizeof($value->articoli) > 0) {

                    foreach ($value->articoli as $articoli) {
                        # code...
                        echo $articoli->nome;
                        echo '<br>';
                    }

                }else {
                    
                    foreach ($value->tokens as $token) {
                        # code...
                        echo $token->code;
                        echo '<br>';
                    }
    
                    echo '---';
                    echo '<br>';
                }
            
            }

            */
            
            /*
            $user = User::find(2);
            $token = Token::find(5);
            $token->user()->associate($user);
            $token->save();

            echo 'associate';
            */

            $code = 'davide';
            $base = base64_decode($code);

            //$foo = app()->make(Worker::class)->result();

            //$this->app->bind('Foo', FooService::class);
            $env = env('APP_ENV');
            echo $app = app()->make(FooInterface::class,[$env])->doSomething();
            
        }
    }

    public function login()
    {
        //$data = ['luca','enzo','pippo'];
        //echo Hash::make('123456');
       return view('login.form');
       //return response()->json(['name' => 'Abigail', 'state' => 'CA']);
    }


    public function amministrazione()
    {   
        
        return view('login.amministrazione');
    }


    public function logout() {
   
        auth()->logout();
        Session::flush();
        return redirect()->route('loginDavide');
        
       }

    
    public function json() {
       
        /*
       $array = [];
       $users = User::all();
       foreach ($users as $user) {
        
            foreach ($user->articoli as $articoli) {
                
                foreach ($user->fatture as $fattura) {

                    $array[] = [
                        'id'=> $user->id,
                        'email'=> $user->email,
                        'articoli' => [
                            'id' => $articoli->id,
                            'titolo' => $articoli->nome,
                            'desc' => $articoli->descrizione
                        ],
                        'fatture' => [
                            'id' => $fattura->id,
                            'titolo' => $fattura->nome_fattura,
                            'desc' => $fattura->descrizione
                        ],
                    ];

                }
            }
        
       }

       return response()->json(['users' => $array], 200); 
       */

        $user = User::find(2);
        $articoli = new Articoli;
        $articoli->nome = 'cc';
        $articoli->descrizione = 'pp';
        $saved = $articoli->user()->associate($user)->save();
        if(!$saved){
            App::abort(500, 'Error');
        }
    }

}
