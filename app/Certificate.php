<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $primaryKey = "id_document";

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
