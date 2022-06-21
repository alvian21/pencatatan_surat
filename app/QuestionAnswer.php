<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    public function pertanyaan()
    {
        return $this->belongsTo('App\Question');
    }
}
