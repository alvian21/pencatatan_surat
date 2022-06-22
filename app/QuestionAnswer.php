<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    public function pertanyaan()
    {
        return $this->belongsTo('App\Question');
    }

    public function hasil()
    {
        return $this->hasOne('App\Answer','question_answer_id', 'id');
    }
}
