<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Penggajian;
use App\Models\Pegawai;
use App\Models\Devisi;
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
        $pegawais = Pegawai::all();
        $row = Devisi::all();
        return view('penggajian.index', compact('data', 'pegawais', 'row'));
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
        
                // if (!$penggajian) {
                //     return redirect()->route('show')->with('error', 'penggajian tidak ditemukan');
                // }
        
                // return view('penggajian.detail_datapenggajian', compact('penggajian'));
                if (!$penggajian) {
            return redirect()->back()->with('error', 'Penggajian not found');
        }

        // Mengambil semua data kehadiran untuk karyawan terkait
         $absensis = Absensi::where('id_pegawai', $penggajian->id_pegawai)->get();

        // Menghitung total denda berdasarkan status kehadiran
        $totalPotongan = 0;

        foreach ($absensis as $absen) {
            switch ($absen->status) {
                case 'alfa':
                    $totalPotongan += 50000;
                    break;
                case 'ijin':
                    $totalPotongan += 25000;
                    break;
                case 'sakit':
                    $totalPotongan += 10000;
                    break;
            }
        }

        // Menghitung total gaji
        $totalGaji = $penggajian->uang_makan + $penggajian->uang_tp - $totalPotongan;

       // Memperbarui total denda dan total gaji di tabel penggajian
        $penggajian->total_potongan = $totalPotongan;
        $penggajian->total_gaji = $totalGaji;
        $penggajian->save();

        // Mengembalikan hasil perhitungan gaji ke view
        //dd($penggajian);
        return view('penggajian.index', compact('penggajian','totalGaji'));
    }
            
        }
   
    

        


