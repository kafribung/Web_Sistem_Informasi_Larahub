<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Pertanyaan extends Model
{
    protected $touches = ['user'];
    protected $guarded = ['created_at', 'updated_at'];
    
    // Relation Many to One  (USER)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Relation One to Many (JAWABAN)
    public function jawabans()
    {
        return $this->hasMany('App\Models\Jawaban');
    }

    // Author
    public function author()
    {
        $user = Auth::check();

        if ($user) {
            return Auth::user()->id == $this->user->id;
        } return false;
    }
}
