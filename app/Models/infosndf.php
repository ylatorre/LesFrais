<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infosndf extends Model
{
    use HasFactory;

    protected $fillable = [
        'Utilisateur',
        'MoisEnCours',
        'DateSoumission',
        'ValideePar',
        'DateValidation',
        'NombreEvenement',
        'Validation',
        'ChevauxFiscaux',
        'ValidationEnCours',
        'Valide',
        'tauxKM'
    ];
}
