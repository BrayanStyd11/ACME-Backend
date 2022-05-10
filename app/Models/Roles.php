<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = "roles";
    protected $guarded = ['id'];
    protected $fillable = ['rol'];

    /**
     * Se crea una Función publica para especificar 
     * la relación foranea de las tablas users->roles
     */
    public function users(){
        return $this->belongsTo(User::class);
    }
}
