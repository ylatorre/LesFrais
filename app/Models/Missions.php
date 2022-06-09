<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Missions extends Model
{
    use HasFactory;
    
   public function user()
   {
       return $this->belongsTo(User::class);
   }

   protected $fillable =[
    'mission',
    'client',
    'ville',
    'code_postal',
    'peage',
    'parking',
    'divers',
    'repas',
    'hotel',
    'km'
   ];
}
