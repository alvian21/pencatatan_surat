<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $primaryKey = "employee_id";

    public function certificate()
    {
        return $this->hasMany('App\Certificate','employee_id','employee_id');
    }
}
