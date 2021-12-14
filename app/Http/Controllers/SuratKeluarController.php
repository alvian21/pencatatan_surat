<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\KodeSurat;
use App\OutgoingMail;
use PDF;
class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat = OutgoingMail::all();
        return view('backend.surat_keluar.index', ['surat' => $surat]);
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
        return view('backend.surat_keluar.create', ['kodesurat' => $kodesurat]);
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
            'kepada' => 'required',
            'nomor_surat' => 'required|unique:outgoing_mails,reference_number_o',
            'tanggal_surat' => 'required',
            'kode_surat' => 'required',
            'perihal' => 'required',
            'dokumen_surat' => 'required|file',
            'tembusan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $surat = new OutgoingMail();
                $surat->id_user = auth()->user()->id_user;
                $surat->reference_number_o = $request->get('nomor_surat');
                $surat->letter_date_o = $request->get('tanggal_surat');
                $surat->to = $request->get('kepada');
                $surat->description_o = $request->get('perihal');
                $surat->copy = $request->get('tembusan');
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
                    $path = $dokumen_surat->storeAs("public/surat_keluar", $filenameSimpan);
                    $surat->attachment = $filenameSimpan;
                }
                $surat->save();
                DB::commit();
                return redirect()->route('surat_keluar.index')->with('success', 'Data Surat Keluar berhasil disimpan');
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
        $surat = OutgoingMail::findOrFail($id);
        return view('backend.surat_keluar.show', ['kodesurat' => $kodesurat, 'surat' => $surat]);
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
        $surat = OutgoingMail::findOrFail($id);
        return view('backend.surat_keluar.edit', ['kodesurat' => $kodesurat, 'surat' => $surat]);
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
            'kepada' => 'required',
            'nomor_surat' => 'required|unique:outgoing_mails,reference_number_o,'.$id.',id_outgoing',
            'tanggal_surat' => 'required',
            'kode_surat' => 'required',
            'perihal' => 'required',
            'dokumen_surat' => 'file',
            'tembusan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $surat = OutgoingMail::findOrFail($id);
                $surat->reference_number_o = $request->get('nomor_surat');
                $surat->letter_date_o = $request->get('tanggal_surat');
                $surat->to = $request->get('kepada');
                $surat->description_o = $request->get('perihal');
                $surat->copy = $request->get('tembusan');
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
                    $path = $dokumen_surat->storeAs("public/surat_keluar", $filenameSimpan);
                    $surat->attachment = $filenameSimpan;
                }
                $surat->save();
                DB::commit();
                return redirect()->route('surat_keluar.index')->with('success', 'Data Surat Keluar berhasil disimpan');
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
            $surat = OutgoingMail::findOrFail($id);
            if (!empty($surat->attachment)) {
                $filesurat = storage_path('app/public/surat_keluar/' . $surat->attachment);
                if (File::exists($filesurat)) {

                    unlink($filesurat);
                }
            }

            if (!empty($surat->paraf)) {
                $fileparaf = storage_path('app/public/surat_keluar/' . $surat->paraf);
                if (File::exists($fileparaf)) {

                    unlink($fileparaf);
                }
            }

            $surat->delete();
            $request->session()->flash('success', 'Data surat keluar berhasil dihapus!');
            return response()->json(['status' => true]);
        }
    }

    public function generateKode(Request $request)
    {
        if ($request->ajax()) {
            $id = OutgoingMail::where('letter_code',$request->get('kode_surat'))->count();
            $lengthid = strlen($id);
            $resid = $id + 1;
            if ($lengthid == 1 || $lengthid == 0) {
                $nomor = "00" . $resid;
            } elseif ($lengthid == 2) {
                $nomor = "0" . $resid;
            } else {
                $nomor = $resid;
            }

            $kodesurat = new KodeSurat();
            $bulan = $kodesurat->getRomawi(date('n'));
            $tahun = date('Y');

            $resnomor = $nomor . "/104.10/smk.pnb/" . $request->get('kode_surat') . "/" . $bulan . "/" . $tahun;
            return response()->json([
                'status' => true,
                'nomor' => $resnomor,
                'lengthid' => $lengthid
            ]);
        }
    }

    public function genRandom()
    {
        $a = mt_rand(100000, 999999);
        return $a;
    }

    public function download($id)
    {
        $surat = OutgoingMail::findOrFail($id);
        $filename = $surat->attachment;
        $file_path = public_path() . '/storage/surat_keluar/' . $filename;

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
                    $surat = OutgoingMail::findOrFail($id);
                    $surat->status = $request->get('status');
                    $surat->status_description = $request->get('keterangan');

                    if ($request->hasFile('paraf')) {
                        $paraf = $request->file('paraf');
                        $dokumen = $paraf->getClientOriginalName();
                        $filename = pathinfo($dokumen, PATHINFO_FILENAME);
                        $extension = $paraf->getClientOriginalExtension();
                        $filenameSimpan = $filename . '_' . time() . $this->genRandom() . '.' . $extension;
                        $path = $paraf->storeAs("public/surat_keluar/paraf", $filenameSimpan);
                        $surat->paraf = $filenameSimpan;
                    }

                    $surat->save();
                    DB::commit();
                    $html = ' <div class="alert alert-success" role="alert">Surat keluar berhasil di update </div>';
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
            $surat = OutgoingMail::where('id_outgoing', $id)->first();
            return response()->json([
                'status' => true,
                'data' => $surat
            ]);
        }
    }

    public function cetak_pdf($id)
    {
    	$surat = OutgoingMail::findOrFail($id);

    	$pdf = PDF::loadview('backend.surat_keluar.pdf',['surat' => $surat]);
    	return $pdf->stream('surat-keluar-pdf');
    }
}
