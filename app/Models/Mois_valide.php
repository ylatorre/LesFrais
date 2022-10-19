<?php

namespace App\Models;

use Database\Factories\Mois_ValidesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mois_valide extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'mois', 'start', 'idEvent', 'end', 'test', 'description', 'title', 'ville', 'code_postal', 'peage', 'parking', 'essence', 'divers', 'repas', 'hotel', 'kilometrage', 'idUser', 'heure_debut', 'heure_fin'];

    protected static function newFactory()
    {
        return Mois_ValidesFactory::new();
    }

}


