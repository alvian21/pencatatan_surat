<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentStudent extends Model
{
    public function student()
    {
        return $this->belongsTo('App\StudentDiploma');
    }
}
