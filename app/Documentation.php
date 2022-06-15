<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $primaryKey = "id_documentation";

    protected $guarded = [];

    public function detail()
    {
        return $this->hasMany('App\DetailDocumentation', 'id_documentation', 'id_documentation');
    }
}
