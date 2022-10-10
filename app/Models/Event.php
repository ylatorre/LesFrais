<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id','start','end','test','description','title','ville','code_postal','peage','peage2','peage3','peage4','parking','essence', 'divers','petitDej','dejeuner','diner','aEmporter','hotel','kilometrage','idUser', 'heure_debut', 'heure_fin', 'mois'];
}
