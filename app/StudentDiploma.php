<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDiploma extends Model
{
    protected $primaryKey = "id_sd";
    protected $guarded = [];

    public function document()
    {
        return $this->hasMany('App\DocumentStudent','id_sd','id_sd');
    }
}
