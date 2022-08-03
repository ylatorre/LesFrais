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
        'NombreEvenement',
        'Validation',
        'ChevauxFiscaux',
    ];
}
