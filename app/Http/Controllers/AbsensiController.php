<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\Devisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    public function index(){
        $data = DB::table('absensis')
                ->join('pegawais', 'absensis.id_pegawai', 'pegawais.id')
                ->select('absensis.*', 'pegawais.nama_pegawai')
                ->latest()
                ->paginate(5);
        
        $data1 = Absensi::all();
        $pegawais = Pegawai::all();
        $row = Devisi::all();
        return view('absensi.index', compact('data', 'data1', 'pegawais', 'row'));
        }

        public function tambahabsensi() 
        {
            $data = Pegawai::all();
            return view('absensi.index', compact('data'));
        }
        public function insertdata_absensi(Request $request)
        {
            //dd($request->all());
        //     Log::info($request->all());
        //      $request->validate([
        //     'id_pegawai' => 'required|exists:pegawais,id_pegawai',
        //     'id_devisi' => 'required|exists:devisis,id_devisi',
        //     'kehadiran' => 'required',
        //     'tanggal' => 'required|date',
        // ]);

            Absensi::create($request->all());
            return redirect()->route('absensi')->with('berhasil','Data Berhasil Ditambahkan');
        //     Log::info($request->all());
        //      $request->validate([
        //     'id_pegawai' => 'required|exists:pegawais,id_pegawai',
        //     'id_devisi' => 'required|exists:devisis,id_devisi',
        //     'kehadiran' => 'required',
        //     'tanggal' => 'required|date',
        // ]);

        // // Buat data baru di tabel absensis
        // Absensi::create([
        //     'id_pegawai' => $request->id_pegawai,
        //     'id_devisi' => $request->id_devisi,
        //     'kehadiran' => $request->kehadiran,
        //     'tanggal' => $request->tanggal,
        // ]);

        // return redirect()->route('absensi')->back()->with('success', 'Absensi berhasil ditambahkan');
        }
        public function tampilkandata_absensi($id)
        {
            $data = Absensi::find($id);
            return view('tampil_dataabsensi', compact('data'));
        }
    public function updatedata_absensi(Request $request, $id)
        {
            $data = Absensi::find($id);
            $data->update($request->all());
            return redirect()->route('absensi')->with('berhasil','Data Berhasil Diupdate');
        }
   
        public function deletedata_absensi($id)
        {
            $data = Absensi::find($id);
            $data->delete();
            return redirect()->route('absensi')->with('berhasil','Data Berhasil Dihapus');
        }
        public function edit(Request $request, $id)
        {
            $data = Absensi::find($id);
            $data->Edit($request->all());
            return redirect()->route('updatedata')->with('berhasil','Data Berhasil Diupdate');
        }
        public function show (Request $request,$id)
        {
            
                $absensi = Absensi::find($id);
        
                if (!$absensi) {
                    return redirect()->route('show')->with('error', 'absensi tidak ditemukan');
                }
        
                return view('absensi.detail_dataabsensi', compact('absensi'));
            
        }
         
       public function getPegawaiHTML()
    {
    $data = Pegawai::all();
    $html = '<option selected>- Pilih -</option>';

    foreach ($data as $pegawai) {
        $html .= '<option value="' . $pegawai->id_pegawai . '">' . $pegawai->nama_pegawai . '</option>';
    }

    return response($html, 200)->header('Content-Type', 'text/html');
    }


}
