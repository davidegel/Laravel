<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Fatture extends Model
{
    
    protected $fillable = [
        'nome_fattura', 'descrizione','url','user_id'
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function articoli()
    {
        return $this->belongsToMany('App\Articoli')
        ->withPivot('tipo', 'user_id');
    }

    public function searchUser($us)
    {
        //return $this->articoli()->pivot->user()->whereIn('id', $us)->first();
    }

}
