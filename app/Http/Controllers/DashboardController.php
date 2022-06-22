<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Employee;
use Illuminate\Http\Request;
use App\IncomingMail;
use App\OutgoingMail;
use App\Question;
use App\QuestionAnswer;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suratmasuk = IncomingMail::count();
        $suratkeluar = OutgoingMail::count();
        $totalkaryawan = Employee::count();
        $pertanyaan = Question::whereHas('detail_jawaban',function($q){
            $q->whereHas('hasil');
        })->count();
        $jawaban = QuestionAnswer::whereHas('hasil',function($q){
            $q->where('periode',date('Y'));
        })->sum('score');

        return view(
            'backend.dashboard.index',
            ['suratmasuk' => $suratmasuk, 'suratkeluar' => $suratkeluar, 'totalkaryawan' => $totalkaryawan, 'jawaban' => $jawaban]
        );
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
        //
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

    public function grafik_karyawan(Request $request)
    {
        if ($request->ajax()) {
            $karyawan = Employee::select('status', DB::raw('count(*) as jumlah'))->groupBy('status')->get();

            return response()->json([
                'data' => $karyawan
            ]);
        }
    }

    public function grafik_dokumen_karyawan(Request $request)
    {
        if ($request->ajax()) {

            $semua = Employee::has('certificate', '>=', 3)->count();
            $sebagian = Employee::has('certificate', '<', 4)->has('certificate', '>=', 1)->count();
            $belum = Employee::has('certificate', '=', 0)->count();

            $arr = [
                [
                    'data' => $semua,
                    'label' => 'semua'
                ],
                [
                    'data' => $sebagian,
                    'label' => 'sebagian'
                ],
                [
                    'data' => $belum,
                    'label' => 'belum'
                ],
            ];
            return response()->json([
                'data' => $arr
            ]);
        }
    }
}
