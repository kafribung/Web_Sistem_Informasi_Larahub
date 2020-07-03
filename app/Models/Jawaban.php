<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $touches = ['user'];
    protected $fillable= ['description', 'pertanyaan_id'];

    // Relation Many to One  (USER)
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Relation Many to One  (USER)
    public function pertanyaan()
    {
        return $this->belongsTo('App\Models\Pertanyaan');
    }
}
