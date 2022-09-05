<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    /**
     * Get all of the comments for the pays.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */

    public function commandes()
    {
        return  $this->hasMany(Commande::class);
    }

    public function comptes()
    {
        return $this->hasMany(Compte::class);
    }


    // public function personne()
    // {
    //     return $this->belongsTo(Personne::class);
    // }

}
