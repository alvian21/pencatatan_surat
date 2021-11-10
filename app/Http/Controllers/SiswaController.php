<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\StudentDiploma;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = StudentDiploma::all();
        return view('backend.siswa.index', ['siswa' => $siswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.siswa.create');
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
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'nama_orangtua' => 'required',
            'nisn' => 'required|unique:student_diplomas,nisn',
            'nis' => 'required|unique:student_diplomas,nis',
            'npsn' => 'required|unique:student_diplomas,npsn',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $siswa = new StudentDiploma();
            $siswa->name = $request->get('nama');
            $siswa->birth_date_s = $request->get('tanggal_lahir');
            $siswa->birth_place_s = $request->get('tempat_lahir');
            $siswa->parents_name = $request->get('nama_orangtua');
            $siswa->nisn = $request->get('nisn');
            $siswa->nis = $request->get('nis');
            $siswa->npsn = $request->get('npsn');
            $siswa->save();
            return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil disimpan');
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
        $siswa = StudentDiploma::findOrFail($id);
        return view('backend.siswa.edit', ['siswa' => $siswa]);
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

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'nama_orangtua' => 'required',
            'nisn' => 'required|unique:student_diplomas,nisn,' . $id . ',id_sd',
            'nis' => 'required|unique:student_diplomas,nis,' . $id . ',id_sd',
            'npsn' => 'required|unique:student_diplomas,npsn,' . $id . ',id_sd',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $siswa = StudentDiploma::findOrFail($id);
            $siswa->name = $request->get('nama');
            $siswa->birth_date_s = $request->get('tanggal_lahir');
            $siswa->birth_place_s = $request->get('tempat_lahir');
            $siswa->parents_name = $request->get('nama_orangtua');
            $siswa->nisn = $request->get('nisn');
            $siswa->nis = $request->get('nis');
            $siswa->npsn = $request->get('npsn');
            $siswa->save();
            return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            StudentDiploma::findOrFail($id)->delete();
            $request->session()->flash('success', 'Data siswa berhasil dihapus!');
            return response()->json(['status' => true]);
        }
    }
}
