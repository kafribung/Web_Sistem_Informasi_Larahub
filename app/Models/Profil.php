<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Profil extends Model
{
    protected $touches = ['user'];
    protected $table = 'profil';
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    // Relation One to One  (USER)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
