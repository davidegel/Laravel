<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Token extends Model
{
    protected $fillable = [
        'id','code','user_id'
    ];

    public $timestamps = false;

    public function user() {
    
        return $this->belongsTo(User::class, 'author_id');
    
    }
}
