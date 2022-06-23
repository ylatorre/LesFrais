<?php

namespace App\Models;

use App\Models\Missions;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mission',
        'title',
        'ville',
        'code_postal',
        'peage',
        'portables',
        'parking',
        'essence',
        'divers',
        'repas',
        'hotel',
        'kilometrage',
        'idUser',
        "vehicule",
        "chevauxFiscaux",
        "dateChevauxFiscaux"
    ];

    public function missions()
    {
        return $this->hasMany(Missions::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
