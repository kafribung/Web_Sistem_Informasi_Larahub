<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class KomenTanya extends Model
{
    protected $touches = ['user', 'pertanyaan'];
    protected $guarded= ['created_at', 'updated_at'];

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
    
     // Author
     public function author()
     {
         $user = Auth::check();
 
         if ($user) {
             return Auth::user()->id == $this->user_id;
         } return false;
     }
}
