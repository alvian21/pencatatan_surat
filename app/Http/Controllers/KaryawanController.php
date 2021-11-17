<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Employee;

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
        return view('backend.karyawan.index',['karyawan' => $karyawan]);
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $karyawan = new Employee();
            $karyawan->id_user = auth()->user()->id;
            $karyawan->name_e = $request->get('nama');
            $karyawan->birth_date = $request->get('tanggal_lahir');
            $karyawan->birth_place = $request->get('tempat_lahir');
            $karyawan->address = $request->get('alamat');
            $karyawan->phone_number = $request->get('nomor_hp');
            $karyawan->last_education = $request->get('pendidikan_terakhir');
            $karyawan->role = $request->get('jabatan');
            $karyawan->save();
            return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil disimpan');
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $karyawan = Employee::findOrFail($id);
            $karyawan->name_e = $request->get('nama');
            $karyawan->birth_date = $request->get('tanggal_lahir');
            $karyawan->birth_place = $request->get('tempat_lahir');
            $karyawan->address = $request->get('alamat');
            $karyawan->phone_number = $request->get('nomor_hp');
            $karyawan->last_education = $request->get('pendidikan_terakhir');
            $karyawan->role = $request->get('jabatan');
            $karyawan->save();
            return redirect()->route('karyawan.index')->with('success', 'Data Karyawan berhasil diupdate');
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
            Employee::findOrFail($id)->delete();
            $request->session()->flash('success', 'Data karyawan berhasil dihapus!');
            return response()->json(['status' => true]);
        }
    }
}
