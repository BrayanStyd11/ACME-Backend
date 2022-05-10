<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $guarded = ['id'];
    protected $fillable = [
        'document',
        'first_name',
        'second_name',
        'lastname',
        'address',
        'phone',
        'city',
        'id_rol',
    ];

    /**
     * Se crea la función para especificar
     * la relación uno a uno de la tabla users->roles
     */

    public function rol(){
        return $this->hasOne(Roles::class,'id','id_rol');
    }

    /**
     * Se realiza la función para traer los datos de
     * la relación foranea con tabla pivote, Vehicles user_vehicles
     */
    public function vehicles(){
        return $this->belongsToMany(Vehicles::class, user_vehicles::class)->withPivot('user_id');
    }
}
