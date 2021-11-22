<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeSurat extends Model
{
    public function kode(){
        $kodesurat = [
            [
                'kode' => 'A',
                'keterangan' => 'PERENCANAAN'
            ],
            [
                'kode' => 'B',
                'keterangan' => 'KEUANGAN'
            ],
            [
                'kode' => 'C',
                'keterangan' => 'KEPEGAWAIAN'
            ],
            [
                'kode' => 'D',
                'keterangan' => 'TNI - AL'
            ],
            [
                'kode' => 'F',
                'keterangan' => 'MUTASI'
            ],
            [
                'kode' => 'G',
                'keterangan' => 'PENDIDIKAN ( DINAS CABANG SEDATI )'
            ],
            [
                'kode' => 'H',
                'keterangan' => 'PENDIDIKAN ( DINAS KABUPATEN )'
            ],
            [
                'kode' => 'I',
                'keterangan' => 'PRAKERIN'
            ],
            [
                'kode' => 'J',
                'keterangan' => 'UJIKOM'
            ],
            [
                'kode' => 'K',
                'keterangan' => 'MUTASI'
            ],
            [
                'kode' => 'L',
                'keterangan' => 'SARANA / PRASANA'
            ], [
                'kode' => 'M',
                'keterangan' => 'HUMAS'
            ],
            [
                'kode' => 'N',
                'keterangan' => 'PROGRAM KERJA'
            ],
            [
                'kode' => 'O',
                'keterangan' => 'YAYASAN'
            ],
            [
                'kode' => 'P',
                'keterangan' => 'TATA USAHA (TU)'
            ],
            [
                'kode' => 'Q',
                'keterangan' => 'CUTI'
            ],
            [
                'kode' => 'R',
                'keterangan' => 'BROSUR'
            ],
            [
                'kode' => 'S',
                'keterangan' => 'SURAT KEMBALI'
            ],
            [
                'kode' => 'T',
                'keterangan' => 'SURAT LAMARAN / PENGAJUAN'
            ],
            [
                'kode' => 'U',
                'keterangan' => 'LAIN - LAIN'
            ],
        ];

        return $kodesurat;
    }
}
