<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function JawabanPertanyaan()
    {
        return $this->belongsTo('App\QuestionAnswer', 'question_answer_id', 'id');
    }
}
