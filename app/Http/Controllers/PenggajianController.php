<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggajianController extends Controller
{
    public function index(){
         $data = DB::table('penggajians')
                ->join('pegawais', 'penggajians.id_pegawai', 'pegawais.id')
                ->select('penggajians.*', 'pegawais.nama_pegawai')
                ->latest()->paginate(5);
        $data = Penggajian::all();
        return view('penggajian.index', compact('data'));
        }

        public function tambahpenggajian() 
        {
            // return view('tambahdatapenggajian);
            // dd($request->all());
            Penggajian::create($request->all());
            return redirect()->route('tambah_datapenggajian')->with('berhasil','Data Berhasil Ditambahkan');
        }
        public function insertdata_penggajian(Request $request)
        {
            //dd($request->all());
            Penggajian::create($request->all());
            return redirect()->route('penggajian')->with('berhasil','Data Berhasil Ditambahkan');
        }
        public function tampilkandata_penggajian($id)
        {
            $data = Penggajian::find($id);
            return view('tampil_datapenggajian', compact('data'));
        }
    public function updatedata_penggajian(Request $request, $id)
        {
            $data = Penggajian::find($id);
            $data->update($request->all());
            return redirect()->route('penggajian')->with('berhasil','Data Berhasil Diupdate');
        }
   
        public function deletedata_penggajian($id)
        {
            $data = Penggajian::find($id);
            $data->delete();
            return redirect()->route('penggajian')->with('berhasil','Data Berhasil Dihapus');
        }
        public function edit(Request $request, $id)
        {
            $data = Penggajian::find($id);
            $data->Edit($request->all());
            return redirect()->route('updatedata')->with('berhasil','Data Berhasil Diupdate');
        }
        public function show (Request $request,$id)
        {
            
                $penggajian = Penggajian::find($id);
        
                if (!$penggajian) {
                    return redirect()->route('show')->with('error', 'penggajian tidak ditemukan');
                }
        
                return view('penggajian.detail_datapenggajian', compact('penggajian'));
            
        }
        public function hitungGaji()
    {
        // Ambil data absensi dan hitung jumlah hari kerja
        $periode = '2024-05'; // Periode tertentu
        $absensi = DB::table('absensis')
            ->join('pegawais', 'absensis.id_pegawai', '=', 'pegawais.id')
            ->select('absensis.id_pegawai', 'pegawais.nama_pegawai', DB::raw('COUNT(absensis.id) as jumlah_hari_kerja'))
            ->where('absensis.tanggal', 'like', $periode . '%')
            ->groupBy('absensis.id_pegawai', 'pegawais.nama_pegawai')
            ->get();

        // Proses perhitungan gaji
        foreach ($absensi as $data) {
            $gajiharian = 400000; // Misalnya, gaji per hari
            $totalGaji = $data->jumlah_hari_kerja * $gajiharian;

            // Simpan ke tabel penggajian
            DB::table('penggajians')->updateOrInsert(
                ['id_pegawai' => $data->id_pegawai, 'periode' => $periode],
                ['total_gaji' => $totalGaji, 'created_at' => now(), 'updated_at' => now()]
            );
        }

        // Ambil data gaji dari tabel penggajian
        $dataGaji = DB::table('penggajians')
            ->join('pegawais', 'penggajians.id_pegawai', '=', 'pegawais.id')
            ->select('penggajians.*', 'pegawais.nama_pegawai')
            ->where('penggajians.periode', $periode)
            ->latest()
            ->paginate(5);

        // Kembalikan data ke view (misalnya)
        return view('penggajian.data_penggajian', compact('dataGaji'));
    }

}
