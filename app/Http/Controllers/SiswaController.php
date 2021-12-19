<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\StudentDiploma;
use App\DocumentStudent;

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
            'file.*' => 'nullable|file'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $siswa = new StudentDiploma();
            $siswa->id_user =  auth()->user()->id_user;
            $siswa->name = $request->get('nama');
            $siswa->birth_date_s = $request->get('tanggal_lahir');
            $siswa->birth_place_s = $request->get('tempat_lahir');
            $siswa->parents_name = $request->get('nama_orangtua');
            $siswa->nisn = $request->get('nisn');
            $siswa->nis = $request->get('nis');
            $siswa->npsn = $request->get('npsn');
            $siswa->save();


            if ($request->hasFile('file')) {
                $file = $request->file('file');
                foreach ($file as $key => $value) {
                    $dokumen = $value->getClientOriginalName();
                    $filename = pathinfo($dokumen, PATHINFO_FILENAME);
                    $extension = $value->getClientOriginalExtension();
                    $filenameSimpan = $filename . '_' . time() . $this->genRandom() . '.' . $extension;
                    $path = $value->storeAs("public/certificate", $filenameSimpan);
                    $tipe = $request->get('tipe')[$key];
                    $sertif = new DocumentStudent();
                    $sertif->id_sd = $siswa->id_sd;
                    $sertif->name = $filenameSimpan;
                    $sertif->type = $tipe;
                    $sertif->upload_date = date('Y-m-d');
                    $sertif->save();
                }
            }

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
        $siswa = StudentDiploma::findOrFail($id);
        return view('backend.siswa.show', ['siswa' => $siswa]);
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
            'file.*' => 'nullable|file'
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

            $tipe = $request->get('old_tipe');
            $id_document = $request->get('id_document');
            if (!empty($tipe)) {
                foreach ($tipe as $key => $tip) {
                    if (isset($id_document[$key])) {

                        $ceksertif = DocumentStudent::whereNotIn('id',  $id_document)->where('id_sd', $siswa->id_sd)->get();

                        if ($ceksertif->isNotEmpty()) {

                            $delsertif = DocumentStudent::whereNotIn('id',  $id_document)->where('id_sd', $siswa->id_sd)->delete();
                        }

                        $sertif = DocumentStudent::where("id", $id_document[$key])->first();
                        if ($sertif) {
                            $sertif->type = $tip;
                            $sertif->save();
                        }
                    }
                }
            } else {
                $ceksertif = DocumentStudent::where('id_sd', $siswa->id_sd)->delete();
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                foreach ($file as $key => $value) {
                    $dokumen = $value->getClientOriginalName();
                    $filename = pathinfo($dokumen, PATHINFO_FILENAME);
                    $extension = $value->getClientOriginalExtension();
                    $filenameSimpan = $filename . '_' . time() . $this->genRandom() . '.' . $extension;
                    $path = $value->storeAs("public/certificate", $filenameSimpan);
                    $tipe = $request->get('tipe')[$key];
                    $sertif = new DocumentStudent();
                    $sertif->id_sd = $siswa->id_sd;
                    $sertif->name = $filenameSimpan;
                    $sertif->type = $tipe;
                    $sertif->upload_date = date('Y-m-d');
                    $sertif->save();
                }
            }
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
            DocumentStudent::where('id_sd', $id)->delete();
            StudentDiploma::findOrFail($id)->delete();
            $request->session()->flash('success', 'Data siswa berhasil dihapus!');
            return response()->json(['status' => true]);
        }
    }

    public function genRandom()
    {
        $a = mt_rand(100000, 999999);
        return $a;
    }
}
