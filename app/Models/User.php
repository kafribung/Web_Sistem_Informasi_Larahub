<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relation One to Many (PERTANYAAN)
    public function pertanyaans()
    {
        return $this->hasMany('App\Models\Pertanyaan');
    }

    // Relation One to Many (JAWABAN)
    public function jawabans()
    {
        return $this->hasMany('App\Models\Jawaban');
    }

    // Relation One to Many (JAWABAN)
    public function komentars()
    {
        return $this->hasMany('App\Models\KomenJawab');
    }

    // Relation One to Many (Komentar Jawaban)
    public function komen_jawabs()
    {
        return $this->hasMany('App\Models\KomenJawab');
    }

    // Relation One to Many (Komentar Jawaban)
    public function komen_tanyas()
    {
        return $this->hasMany('App\Models\KomenTanya');
    }


    // Relation One to One (Profil)
    public function profil()
    {
        return $this->hasOne('App\Models\Profil');
    }
}
