<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $devisi = [
        ['nama_devisi' => 'HRD', 'jabatan' => 'Koordinator', 'gaji_harian' => 500000, 'gaji_pokok' => 5000000],
        ['nama_devisi' => 'HRD', 'jabatan' => 'Staff', 'gaji_harian' => 400000, 'gaji_pokok' => 4000000],
        ['nama_devisi' => 'Keuangan', 'jabatan' => 'Koordinator', 'gaji_harian' => 500000, 'gaji_pokok' => 5000000],
        ['nama_devisi' => 'Keuangan', 'jabatan' => 'Staff', 'gaji_harian' => 400000, 'gaji_pokok' => 4000000],
        ['nama_devisi' => 'Pemasaran', 'jabatan' => 'Koordinator', 'gaji_harian' => 500000, 'gaji_pokok' => 5000000],
        ['nama_devisi' => 'Pemasaran', 'jabatan' => 'Staff', 'gaji_harian' => 400000, 'gaji_pokok' => 4000000],
        ['nama_devisi' => 'Produksi', 'jabatan' => 'Koordinator', 'gaji_harian' => 500000, 'gaji_pokok' => 5000000],
        ['nama_devisi' => 'Produksi', 'jabatan' => 'Staff', 'gaji_harian' => 400000, 'gaji_pokok' => 4000000],
        ['nama_devisi' => 'Umum', 'jabatan' => 'Koordinator', 'gaji_harian' => 5000000, 'gaji_pokok' => 5000000],
        ['nama_devisi' => 'Umum', 'jabatan' => 'Staff', 'gaji_harian' => 5000000, 'gaji_pokok' => 4000000],
        ['nama_devisi' => 'Teknologi', 'jabatan' => 'Koordinator', 'gaji_harian' => 5000000, 'gaji_pokok' => 5000000],
        ['nama_devisi' => 'Teknologi dan Informasi', 'jabatan' => 'Staff', 'gaji_harian' => 5000000, 'gaji_pokok' => 4000000],
        // Tambahkan data devisi lainnya sesuai kebutuhan
    ];

    // Insert data devisi ke tabel 'devisis'
    DB::table('devisis')->insert($devisi);
    }
       
}
