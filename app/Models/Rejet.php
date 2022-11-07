<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejet extends Model
{
    use HasFactory;
    protected $fillable = ['TextRejet','UserName','UserID','MoisNDF','RejectedBy'];
}
