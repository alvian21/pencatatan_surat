<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Employee;
use App\Certificate;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Employee::all();
        return view('backend.karyawan.index', ['karyawan' => $karyawan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.karyawan.create');
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
            'alamat' => 'required',
            'nomor_hp' => 'required|unique:employees,phone_number',
            'pendidikan_terakhir' => 'required',
            'jabatan' => 'required',
            'file.*' => 'nullable|file'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $karyawan = new Employee();
                $karyawan->id_user =  auth()->user()->id_user;
                $karyawan->name_e = $request->get('nama');
                $karyawan->birth_date = $request->get('tanggal_lahir');
                $karyawan->birth_place = $request->get('tempat_lahir');
                $karyawan->address = $request->get('alamat');
                $karyawan->phone_number = $request->get('nomor_hp');
                $karyawan->last_education = $request->get('pendidikan_terakhir');
                $karyawan->role = $request->get('jabatan');
                $karyawan->status = $request->get('status');
                $karyawan->save();


                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    foreach ($file as $key => $value) {
                        $dokumen = $value->getClientOriginalName();
                        $filename = pathinfo($dokumen, PATHINFO_FILENAME);
                        $extension = $value->getClientOriginalExtension();
                        $filenameSimpan = $filename . '_' . time() . $this->genRandom() . '.' . $extension;
                        $path = $value->storeAs("public/certificate", $filenameSimpan);
                        $tipe = $request->get('tipe')[$key];
                        $sertif = new Certificate();
                        $sertif->employee_id = $karyawan->employee_id;
                        $sertif->name_c = $filenameSimpan;
                        $sertif->type = $tipe;
                        $sertif->upload_date = date('Y-m-d');
                        $sertif->save();
                    }
                }
                DB::commit();
                return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil disimpan');
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
            }
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
        $karyawan = Employee::findOrFail($id);
        return view('backend.karyawan.show', ['karyawan' => $karyawan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = Employee::findOrFail($id);
        return view('backend.karyawan.edit', ['karyawan' => $karyawan]);
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
            'alamat' => 'required',
            'nomor_hp' => 'required|unique:employees,phone_number,' . $id . ',employee_id',
            'pendidikan_terakhir' => 'required',
            'jabatan' => 'required',
            'file.*' => 'nullable|file'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $karyawan = Employee::findOrFail($id);
                $karyawan->name_e = $request->get('nama');
                $karyawan->birth_date = $request->get('tanggal_lahir');
                $karyawan->birth_place = $request->get('tempat_lahir');
                $karyawan->address = $request->get('alamat');
                $karyawan->phone_number = $request->get('nomor_hp');
                $karyawan->last_education = $request->get('pendidikan_terakhir');
                $karyawan->role = $request->get('jabatan');
                $karyawan->status = $request->get('status');
                $karyawan->save();

                $tipe = $request->get('old_tipe');
                $id_document = $request->get('id_document');
                if(!empty($tipe)){
                    foreach ($tipe as $key => $tip) {
                        if (isset($id_document[$key])) {

                            $ceksertif = Certificate::whereNotIn('id_document',  $id_document)->where('employee_id', $karyawan->employee_id)->get();

                            if ($ceksertif->isNotEmpty()) {
                                // foreach ($ceksertif as $del) {
                                //     unlink(storage_path('app/public/certificate/' . $del->name_c));
                                // }
                                $delsertif = Certificate::whereNotIn('id_document',  $id_document)->where('employee_id', $karyawan->employee_id)->delete();
                            }

                            $sertif = Certificate::where("id_document",$id_document[$key])->first();
                            if($sertif){
                                $sertif->type = $tip;
                                $sertif->save();
                            }

                        }
                    }
                }else{
                    $ceksertif = Certificate::where('employee_id', $karyawan->employee_id)->delete();
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
                        $sertif = new Certificate();
                        $sertif->employee_id = $karyawan->employee_id;
                        $sertif->name_c = $filenameSimpan;
                        $sertif->type = $tipe;
                        $sertif->upload_date = date('Y-m-d');
                        $sertif->save();
                    }
                }
                DB::commit();
                return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil diupdate');
            } catch (\Exception $th) {

                DB::rollBack();
                dd($th);
            }
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
            $karyawan = Employee::findOrFail($id);
            $ceksertif = Certificate::where('employee_id', $karyawan->employee_id)->get();
            if ($ceksertif->isNotEmpty()) {
                foreach ($ceksertif as $del) {
                    unlink(storage_path('app/public/certificate/' . $del->name_c));
                }
                $delsertif = Certificate::where('employee_id', $karyawan->employee_id)->delete();
            }
            $karyawan->delete();
            $request->session()->flash('success', 'Data karyawan berhasil dihapus!');
            return response()->json(['status' => true]);
        }
    }

    public function genRandom()
    {
        $a = mt_rand(100000, 999999);
        return $a;
    }
}
