<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeSurat extends Model
{
    public function kode()
    {
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


    public function getRomawi($bln)
    {
        switch ($bln) {
            case 1:
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }
}
