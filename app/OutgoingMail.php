<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutgoingMail extends Model
{
    protected $primaryKey = "id_outgoing";
    protected $guarded = [];
}
