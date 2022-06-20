<?php

namespace App\Http\Controllers;

use App\IncomingMail;
use App\OutgoingMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.laporan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'periode_awal' => 'required',
            'periode_akhir' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $status = $request->get('status');
            $periode_awal = $request->get('periode_awal');
            $periode_awal = Carbon::parse($periode_awal)->format('Y-m-d');

            $periode_akhir = $request->get('periode_akhir');
            $periode_akhir = Carbon::parse($periode_akhir)->format('Y-m-d');

            if ($status == 'Surat Masuk') {
                $data = IncomingMail::whereDate('letter_date_i', '>=', $periode_awal)->whereDate('letter_date_i', '<=', $periode_akhir)->get();
            } else {
                $data = OutgoingMail::whereDate('letter_date_o', '>=', $periode_awal)->whereDate('letter_date_o', '<=', $periode_akhir)->get();
            }

            $pdf = PDF::loadview('backend.laporan.pdf', ['data' => $data, 'status' => $status, 'periode_awal' => $periode_awal, 'periode_akhir' => $periode_akhir]);
            return $pdf->stream('laporan-surat-pdf');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
