<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public static function dataJawaban()
    {
        $jawaban = [
            [
                'nilai' => 'A',
                'bobot' => 4
            ],
            [
                'nilai' => 'B',
                'bobot' => 3
            ],
            [
                'nilai' => 'C',
                'bobot' => 2.5
            ],
            [
                'nilai' => 'D',
                'bobot' => 2
            ],
            [
                'nilai' => 'E',
                'bobot' => 1
            ]
        ];
        return $jawaban;
    }

    public function detail_jawaban()
    {
        return $this->hasMany('App\QuestionAnswer');
    }
}
