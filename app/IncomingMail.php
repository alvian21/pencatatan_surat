<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomingMail extends Model
{
    protected $primaryKey = "id_incoming";
    protected $guarded = [];
}
