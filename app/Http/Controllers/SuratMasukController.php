<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PDF;
use Illuminate\Http\Request;
use App\IncomingMail;
use App\KodeSurat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat = IncomingMail::all();
        return view('backend.surat_masuk.index', ['surat' => $surat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodesurat = new KodeSurat();
        $kodesurat = $kodesurat->kode();
        return view('backend.surat_masuk.create', ['kodesurat' => $kodesurat]);
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
            'dari' => 'required',
            'kepada' => 'required',
            'posisi' => 'required',
            'nomor_surat' => 'required|unique:incoming_mails,reference_number_i',
            'tanggal_masuk' => 'required',
            'tanggal_surat' => 'required',
            'kode_surat' => 'required',
            'perihal' => 'required',
            'dokumen_surat' => 'required|file',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $surat = new IncomingMail();
                $surat->id_user = auth()->user()->id_user;
                $surat->reference_number_i = $request->get('nomor_surat');
                $surat->date_of_receipt = $request->get('tanggal_masuk');
                $surat->letter_date_i = $request->get('tanggal_surat');
                $surat->from = $request->get('dari');
                $surat->to = $request->get('kepada');
                $surat->position = $request->get('posisi');
                $surat->description_i = $request->get('perihal');
                $surat->status = "BELUM DISETUJUI";
                $surat->letter_code = $request->get('kode_surat');
                $kodesurat = new KodeSurat();
                $kodesurat = $kodesurat->kode();
                $keykode = array_search($surat->letter_code, array_column($kodesurat, 'kode'));
                $kodesuratdesc = $kodesurat[$keykode]['keterangan'];
                $surat->description_letter_code = $kodesuratdesc;
                if ($request->hasFile('dokumen_surat')) {
                    $dokumen_surat = $request->file('dokumen_surat');
                    $dokumen = $dokumen_surat->getClientOriginalName();
                    $filename = pathinfo($dokumen, PATHINFO_FILENAME);
                    $extension = $dokumen_surat->getClientOriginalExtension();
                    $filenameSimpan = $filename . '_' . time() . $this->genRandom() . '.' . $extension;
                    $path = $dokumen_surat->storeAs("public/surat_masuk", $filenameSimpan);
                    $surat->scan = $filenameSimpan;
                }
                $surat->save();
                DB::commit();
                return redirect()->route('surat_masuk.index')->with('success', 'Data Surat Masuk berhasil disimpan');
            } catch (\Exception $th) {

                dd($th);
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
        $kodesurat = new KodeSurat();
        $kodesurat = $kodesurat->kode();
        $surat = IncomingMail::findOrFail($id);
        return view('backend.surat_masuk.show', ['kodesurat' => $kodesurat, 'surat' => $surat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kodesurat = new KodeSurat();
        $kodesurat = $kodesurat->kode();
        $surat = IncomingMail::findOrFail($id);
        return view('backend.surat_masuk.edit', ['kodesurat' => $kodesurat, 'surat' => $surat]);
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
            'dari' => 'required',
            'kepada' => 'required',
            'posisi' => 'required',
            'nomor_surat' => 'required|unique:incoming_mails,reference_number_i,' . $id . ',id_incoming',
            'tanggal_masuk' => 'required',
            'tanggal_surat' => 'required',
            'kode_surat' => 'required',
            'perihal' => 'required',
            'dokumen_surat' => 'nullable|file',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $surat = IncomingMail::findOrFail($id);
                $surat->reference_number_i = $request->get('nomor_surat');
                // $surat->date_of_receipt = $request->get('tanggal_masuk');
                $surat->letter_date_i = $request->get('tanggal_surat');
                $surat->from = $request->get('dari');
                $surat->to = $request->get('kepada');
                $surat->position = $request->get('posisi');
                $surat->description_i = $request->get('perihal');
                $surat->status = "BELUM DISETUJUI";
                $surat->letter_code = $request->get('kode_surat');
                $kodesurat = new KodeSurat();
                $kodesurat = $kodesurat->kode();
                $keykode = array_search($surat->letter_code, array_column($kodesurat, 'kode'));
                $kodesuratdesc = $kodesurat[$keykode]['keterangan'];
                $surat->description_letter_code = $kodesuratdesc;
                if ($request->hasFile('dokumen_surat')) {
                    $dokumen_surat = $request->file('dokumen_surat');
                    $dokumen = $dokumen_surat->getClientOriginalName();
                    $filename = pathinfo($dokumen, PATHINFO_FILENAME);
                    $extension = $dokumen_surat->getClientOriginalExtension();
                    $filenameSimpan = $filename . '_' . time() . $this->genRandom() . '.' . $extension;
                    $path = $dokumen_surat->storeAs("public/surat_masuk", $filenameSimpan);
                    $surat->scan = $filenameSimpan;
                }
                $surat->save();
                DB::commit();
                return redirect()->route('surat_masuk.index')->with('success', 'Data Surat Masuk berhasil diupdate');
            } catch (\Exception $th) {

                dd($th);
                DB::rollBack();
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
            $surat = IncomingMail::findOrFail($id);
            if (!empty($surat->scan)) {
                $filesurat = storage_path('app/public/surat_masuk/' . $surat->scan);
                if (File::exists($filesurat)) {

                    unlink($filesurat);
                }
            }

            if (!empty($surat->paraf)) {
                $fileparaf = storage_path('app/public/surat_masuk/' . $surat->paraf);
                if (File::exists($fileparaf)) {

                    unlink($fileparaf);
                }
            }

            $surat->delete();
            $request->session()->flash('success', 'Data surat masuk berhasil dihapus!');
            return response()->json(['status' => true]);
        }
    }
    public function genRandom()
    {
        $a = mt_rand(100000, 999999);
        return $a;
    }

    public function download($id)
    {
        $surat = IncomingMail::findOrFail($id);
        $filename = $surat->scan;
        $file_path = public_path() . '/storage/surat_masuk/' . $filename;

        if (file_exists($file_path)) {
            // Send Download
            return Response::download($file_path, $filename, [
                'Content-Length: ' . filesize($file_path)
            ]);
        } else {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

    public function update_kepsek(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'status' => 'required',
                'id' => 'required',
                'paraf' => 'required|file',
                'keterangan' => 'nullable',
            ]);


            if ($validator->fails()) {
                $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

                return response()->json([
                    'status' => false,
                    'data' => $html
                ]);
            } else {

                // return response()->json($request->all());
                DB::beginTransaction();

                try {
                    $id = $request->get('id');
                    $surat = IncomingMail::findOrFail($id);
                    $surat->status = $request->get('status');
                    $surat->status_description = $request->get('keterangan');

                    if ($request->hasFile('paraf')) {
                        $paraf = $request->file('paraf');
                        $dokumen = $paraf->getClientOriginalName();
                        $filename = pathinfo($dokumen, PATHINFO_FILENAME);
                        $extension = $paraf->getClientOriginalExtension();
                        $filenameSimpan = $filename . '_' . time() . $this->genRandom() . '.' . $extension;
                        $path = $paraf->storeAs("public/surat_masuk/paraf", $filenameSimpan);
                        $surat->paraf = $filenameSimpan;
                    }

                    $surat->save();
                    DB::commit();
                    $html = ' <div class="alert alert-success" role="alert">Surat masuk berhasil di update </div>';
                    return response()->json([
                        'status' => true,
                        'data' => $html
                    ]);
                } catch (\Exception $th) {
                    DB::rollBack();
                }
            }
        }
    }

    public function getDataSurat(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $surat = IncomingMail::where('id_incoming', $id)->first();
            return response()->json([
                'status' => true,
                'data' => $surat
            ]);
        }
    }


    public function cetak_pdf($id)
    {
    	$surat = IncomingMail::findOrFail($id);

    	$pdf = PDF::loadview('backend.surat_masuk.pdf',['surat' => $surat]);
    	return $pdf->stream('surat-masuk-pdf');
    }
}
