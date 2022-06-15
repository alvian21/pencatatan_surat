<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailDocumentation extends Model
{
    public function documentation()
    {
        return $this->belongsTo('App\Documentation', 'id_documentation', 'id_documentation');
    }
}
