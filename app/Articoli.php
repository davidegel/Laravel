<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articoli extends Model {
 
    protected $fillable = [
        'id','nome','descrizione','user_id'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function fatture()
    {
        return $this->belongsToMany('App\Fatture')->withPivot('tipo', 'articoli_id');
    }

    public function leggiUtenti()
    {
        return $this->belongsTo('App\User','author_id','active');
    }
}
