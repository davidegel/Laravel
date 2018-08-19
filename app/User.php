<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Articoli;
use App\Role;
use App\Fatture;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use EntrustUserTrait; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email','password','data','active'
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRememberTokenName()
    {
     return null; // not supported
    }

    public function setAttribute($key, $value) {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();
    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }

    public function articoli()
    {
        return $this->hasMany(Articoli::class);
    }
    
    public function fatture()
    {
        return $this->hasMany(Fatture::class);
    }

    public function fattureOne()
    {
        return $this->hasOne(Fatture::class);
    }

    public function roles() {
    
        return $this->belongsToMany(Role::class);
    
    }

    public function authorizeRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || 
                    abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || 
                abort(401, 'This action is unauthorized.');
        }

        /**
        * Check multiple roles
        * @param array $roles
        */
     public function hasAnyRole($roles) {
            return null !== $this->roles()->whereIn('name', $roles)->first();
        }

        /**
        * Check one role
        * @param string $role
        */
    public function hasRole($role) {
           return null !== $this->roles()->where('name', $role)->first();
        }
    
    public function isActive() {
         return $this->active;
    }

    public function token()
    {
        return $this->hasOne('App\Token');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token','author_id');
    }

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function leggiArticoli()
    {
        return $this->hasMany('App\Articoli','author_id','active');
    }
}
