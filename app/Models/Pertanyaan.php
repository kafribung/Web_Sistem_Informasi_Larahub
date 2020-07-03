<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $touches = ['user'];
    protected $guarded = ['created_at', 'updated_at'];
    
    // Relation Many to One  (USER)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
