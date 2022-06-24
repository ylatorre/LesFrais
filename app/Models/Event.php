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
    protected $fillable = ['id','start', 'end','test','description','title','ville','code_postal','peage','parking','essence', 'divers','repas','hotel','kilometrage','idUser'];
}
