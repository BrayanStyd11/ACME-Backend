<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    protected $guarded = ['id'];
    protected $fillable = [
        'plate',
        'color',
        'brand',
        'type',
    ];

    /**
     * Se realiza la función para traer los datos de
     * la relación foranea con tabla pivote, users user_vehicles
     */
    public function users(){
        return $this->belongsToMany(User::class, user_vehicles::class)->withPivot('vehicles_id');
    }
}
