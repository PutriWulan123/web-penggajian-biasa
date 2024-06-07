<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\Devisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function index(){
        $data = DB::table('absensis')
                ->join('pegawais', 'absensis.id_pegawai', 'pegawais.id')
                ->select('absensis.*', 'pegawais.nama_pegawai')
                ->latest()->paginate(5);
        $data = Absensi::all();
        $item = Pegawai::all();
        return view('absensi.index', compact('data', 'item'));
        }

        public function tambahabsensi() 
        {
            $data = Pegawai::all();
            $data = Devisi::all();
            return view('absensi.index', compact('data'));
        }
        public function insertdata_absensi(Request $request)
        {
            //dd($request->all());
            Absensi::create($request->all());
            return redirect()->route('absensi')->with('berhasil','Data Berhasil Ditambahkan');
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

}
