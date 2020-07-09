<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomenJawab extends Model
{
    protected $touches = ['user', 'jawaban'];
    protected $table = 'komenjawab';
    protected $guarded= ['created_at', 'updated_at'];

     // Relation Many to One  (USER)
     public function user()
     {
         return $this->belongsTo('App\Models\User');
     }

      // Relation Many to One  (USER)
    public function jawaban()
    {
        return $this->belongsTo('App\Models\Jawaban');
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
