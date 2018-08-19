<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Articoli;
use App\Persone;
use App\Role;
use Crypt;
use App\Fatture;
use App\Token;
use Event;
use App\Events\UserEvent;
use App\Events\ActionDone;
use Pusher\Pusher;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Library\Services\DemoOne;
use App\Library\Services\SendMail;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    
    public function index($name = 'John')
    {
        
        $user = User::all();
        
        /*
        foreach ($user as $value) {
           
            echo $value->nome.' ';
            
            foreach ($value->articoli as $articoli) {
                
                echo $articoli->titolo . '<br>';
            }
        }

        */

        $articoli = Articoli::all();

        foreach ($articoli as $value) {
           
            echo $value->titolo.' ';
            echo $value->user->nome;
        }

        return new Response();
    }

    public function createUser()
    {   
        /*
        $role_employee = Role::where('name', 'employee')->first();
        $role_manager  = Role::where('name', 'manager')->first();
        

        $employee = new User();
        $employee->name = 'Manager Name';
        $employee->email = 'b@b.it';
        $employee->password = bcrypt('4321');
        $saved = $employee->save();
        $employee->roles()->attach($role_manager);
        */
        

        $employee = new User();
        $employee->name = 'bex';
        $employee->email = 'bexty@b.it';
        $employee->password = bcrypt('4321');
        //$employee->fatture()->attach($fatture);
        //$employee->fatture()->add($fatture);
        $employee->save();

        $fatture = new Fatture();
        $fatture->nome_fattura = 'fattura uno';
        $fatture->descrizione = 'descr fattura';
        $fatture->url = "url";
        $fatture->user()->associate($employee);
        $saved = $fatture->save();

        if(!$saved){
            App::abort(500, 'Error');
        }

        return new Response('created');
        
    }


    public function accessUser()
    {
        /*
        $roles = ['manager'];
        $user->authorizeRoles($roles);
        return new Response('accesso ok');
        */
        
        $user = User::find(6);

        echo $fattura = $user->fattureOne->nome_fattura;

        return new Response('');
    }

    
    public function eventUser(Request $req) {
    
        /*
        $user = User::find(6);
        $fatture = new Fatture();
        $event = event(new UserEvent($user,$fatture));
        if(!$event) {

            echo 'fall';
            exit();
        }

        echo 'ok';
        */
        
        /*
        $user = User::find(6);
        $fatture = new Fatture();
        $event = event(new UserEvent($user,$fatture));
        return view('admin.brod');
        */

        //return redirect()->route('utente', ['name' => 'marrco']);

        /*
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = "";

        for ($i=0; $i < 10 ; $i++) { 
             
             $code .= $chars[mt_rand(0, strlen($chars)-1)];
        }

        echo $code;
        */
    
        /*
        $articoli = Articoli::where('id', 1)->first();
        $array = [0 => 5, 1 => 6];
        $string=implode(',',$array);
        //$fattura = Fatture::find(5);
        
        for ($i=0; $i < count($array); $i++) { 
         
            DB::table('articoli_fatture')->where('articoli_id', 1)
            ->update(array('fatture_id' => $array[$i]));
            
        }  
        */
        
        /*
        $authorId = 2;
        $fatture = Articoli::whereHas('user', function ($q) use ($authorId) {
            $q->where('user_id', $authorId);
        })->get();
        */
        
        /*
        $articoli = Articoli::find(2)->id;
        $fattura = Fatture::join('articoli_fatture as af', 'af.fatture_id', '=', 'fattures.id')
        ->join('fattures as f', 'f.id', '=', 'af.fatture_id')
        ->where('f.id','=', 6)->update(['af.articoli_id' => $articoli]);
        */
        
        /*
        $persone = Persone::groupBy('regione')->select('regione', DB::raw('count(eta) as utenti'))
        ->havingRaw("utenti > 2")
        ->get();
        
        foreach ($persone as $value) {
            echo $value->utenti . ' - ' . $value->regione. '<p>';
        }
        */
        
        /*
        $articoli = Articoli::find(2)->id;
        $fattura =  Fatture::find(6);
        $userId = [];
        foreach ($fattura->articoli as $value) {
            $userId[] = $value->pivot->user_id;
        }
        $user = User::whereIn('id', $userId)->get();
        */

        /*
        $utente = User::find(2);
        $articoli = new Articoli;
        $articoli->nome = "mio art";
        $articoli->descrizione = "mio art";
        $articoli->leggiUtenti()->associate($utente);
        $articoli->save();
        */
        
        /*
        $articoli = Articoli::all();
        foreach ($articoli as $art) {
            if($art->fatture()->exists()) {
                echo $art->nome .'<br>';
                foreach ($art->fatture as $fatture) {
                    echo $fatture->nome_fattura . '<br>';
                }
            }else {
                echo '';
            }
            echo '<br>';
        }
        */
        
        /*
        $articolo = Articoli::find(4);
        $fattura = Fatture::whereIn('id',$req->fatture)->get();
        $articolo->fatture()->sync($fattura);
        */

        //$articoli = Articoli::join('articoli_fatture as af', 'af.articoli_id', '=', 'articolis.id')
        //->pluck('articolis.id');
        $articoliAll = Articoli::all();
        
        /*
        foreach ($articoliAll as $art) {
            if($articoli->contains($art->id)) {
                echo 'ok' . $art->id . '<p>';
            }else {
                echo 'no' . $art->id . '<p>';
            }
        }
        */

        foreach ($articoliAll as $value) {
            if($value->fatture()->exists()) {
                foreach ($value->fatture as $fatture) {
                    $var = $value->id .' ok <br>';
                }
              }else {
                    $var = $value->id . ' no <br>';
              }

            echo $var;
        }
        

    }


    public function formRegistrazione()
    {
       return view('register');
    }

    
    public function registrazioneUtente(DemoOne $demo, Request $req, SendMail $sendMail)
    {
        // generate code 
        /*
        date_default_timezone_set('Europe/Rome');
        $user = User::where('email','=','employee@example.com')->firstOrFail();
        $endTime = date("Y-m-d H:i",time() + 120);
        $user->data = $endTime;
        $user->push();

        $code = '7S86S3487H';
        $toke = Token::where('user_id', '=' ,$user->id)->firstOrFail();
        $encrypted = Crypt::encrypt($code);
        $toke->code = $encrypted;
        $toke->push();
        */
        date_default_timezone_set('Europe/Rome');
        $name = $req->input('name');
        $email = $req->input('email');
        $pwd = $req->input('pwd');
        $code = '7S86S3487H';
        $encrypted = Crypt::encrypt($code);
        $data = ['email' => $email, 'name' => $name, 'pwd' => $pwd, 'code' => $encrypted];
        
        /*
        $userd = User::where('email','=',$data['email'])->firstOrFail();
        $code = '7S86S3487H';
        $toke = Token::where('user_id', '=' ,$userd->id)->firstOrFail();
        $encrypted = Crypt::encrypt($code);
        $toke->code = $encrypted;
        $toke->push();
        */
        
        
        if($demo->utenteRegistrazione($data)) {

            $sendMail->setParamMail($data['email'],$data['code']);
            $mal = $sendMail->inviaMail();
            echo $mal['message'];
        }
        
        
    }

    public function verifyCode($email,$code)
    {
       
        date_default_timezone_set('Europe/Rome');
        if (!User::where('email', '=', $email)->count() > 0) {
            echo 'utnte non esiste';
            exit();
        }
        $user = User::where('email','=',$email)->firstOrFail();
        $ora_db = date('H:i', strtotime($user->data));
        $data_db = date('Y-m-d', strtotime($user->data));
        
        $oraServer=time();
        $oraServer=date('H:i', $oraServer);
        $dataServer = date('Y-m-d');
        
        //$code = '7S86S3487H';
        
        
        if($dataServer > $data_db) {

            echo 'sessione scaduta';
            exit();
        }else {

        if($oraServer > $ora_db) {

            echo 'sessione scaduta';
            exit();
       
        }else {
      
            $toke = Token::where('user_id', '=' ,$user->id)->firstOrFail();  
            $code_db = Crypt::decrypt($toke->code);
            $code_url = Crypt::decrypt($code);

            if($code_db == $code_url) {
            
                $user->active = 1;
                $user->push();
                echo 'il tuo account e stato attivato';

            }
        }

      }
         
    }

    public function ajaxResources() {

        $data = [
            'utenti' => [
  
                0 => [
                'nome' => 'luca', 'cognome' => 'rossi', 
                'auto' => ['fiat panda','ford']
                    ],
                1 => [
                    'nome' => 'peppe', 'cognome' => 'brdi', 
                    'auto' => ['opel corsa','bmw']
                    ]
            ]
        ];
        
        return response()->json(['dati'=>$data]);

    }

    public function ajax()
    {

        return view("ajax");
    }

    public function ajaxPost(Request $req)
    {
        
        if($req->method() == "POST" && $req->input('action') == 'invia') {
            
            $nome = $req->input('nome');
            $email = $req->input('email');
            
            $user = new User();
            $user->name = $nome;
            $user->email = $email;
            $password = Hash::make('7854');
            $user->password = $password;
            $endTime = date("Y-m-d H:i",time());
            $user->data = $endTime;
            if($user->save()) {
                 
              $data = ['msg' => 'inserimento riuscito'];
              return response()->json($data);

            }else {

                $data = ['msg' => 'inserimento fallito'];
                return response()->json($data);
            }

        }else {

            $data = ['msg' => 404];
            return response()->json($data); 
        }  
        
    }


    public function riservata()
    {
        echo 'riservata';
    }

}
