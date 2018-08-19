<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

  protected $fillable = [
    'id', 'name','description'
  ];

    public $timestamps = false;
    
    /*
    public function users(){
      return $this->belongsToMany(User::class);
    }
    */
   
}
