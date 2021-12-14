<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Documentation;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumentasi = Documentation::all();

        return view('backend.dokumentasi.index', ['dokumentasi' => $dokumentasi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.dokumentasi.create');
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
            'nama_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'jumlah_peserta' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|file',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $dokumentasi = new Documentation();
            $dokumentasi->id_user = auth()->user()->id_user;
            $dokumentasi->name_of_activity = $request->get('nama_kegiatan');
            $dokumentasi->activity_place = $request->get('tempat_kegiatan');
            $dokumentasi->activity_date = $request->get('tanggal_kegiatan');
            $dokumentasi->number_of_participant = $request->get('jumlah_peserta');
            $dokumentasi->description_d = $request->get('deskripsi');
            if ($request->hasFile('gambar')) {
                $filenameWithExt = $request->file('gambar')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('gambar')->storeAs("public/image", $filenameSimpan);
                $dokumentasi->image = $filenameSimpan;
            }

            $dokumentasi->save();

            return redirect()->route('dokumentasi.index')->with('success', 'Data Dokumentasi berhasil disimpan');
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
        $dokumentasi = Documentation::findOrFail($id);
        return view('backend.dokumentasi.show', ['dokumentasi' => $dokumentasi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumentasi = Documentation::findOrFail($id);
        return view('backend.dokumentasi.edit', ['dokumentasi' => $dokumentasi]);
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
            'nama_kegiatan' => 'required',
            'tempat_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'jumlah_peserta' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|file',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $dokumentasi = Documentation::findOrFail($id);
          
            $dokumentasi->name_of_activity = $request->get('nama_kegiatan');
            $dokumentasi->activity_place = $request->get('tempat_kegiatan');
            $dokumentasi->activity_date = $request->get('tanggal_kegiatan');
            $dokumentasi->number_of_participant = $request->get('jumlah_peserta');
            $dokumentasi->description_d = $request->get('deskripsi');
            if ($request->hasFile('gambar')) {
                $filenameWithExt = $request->file('gambar')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('gambar')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('gambar')->storeAs("public/image", $filenameSimpan);
                $dokumentasi->image = $filenameSimpan;
            }
            $dokumentasi->save();

            return redirect()->route('dokumentasi.index')->with('success', 'Data Dokumentasi berhasil diupdate');
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
            $dokumentasi = Documentation::findOrFail($id);
            unlink(storage_path('app/public/image/'.$dokumentasi->image));
            $dokumentasi->delete();
            $request->session()->flash('success', 'Data dokumentasi berhasil dihapus!');
            return response()->json(['status' => true]);
        }
    }
}
