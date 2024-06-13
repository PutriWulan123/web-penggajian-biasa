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
        ['nama_devisi' => 'HRD', 'jabatan' => 'Koordinator'],
        ['nama_devisi' => 'HRD', 'jabatan' => 'Staff'],
        ['nama_devisi' => 'Keuangan', 'jabatan' => 'Koordinator'],
        ['nama_devisi' => 'Keuangan', 'jabatan' => 'Staff'],
        ['nama_devisi' => 'Pemasaran', 'jabatan' => 'Koordinator'],
        ['nama_devisi' => 'Pemasaran', 'jabatan' => 'Staff'],
        ['nama_devisi' => 'Produksi', 'jabatan' => 'Koordinator'],
        ['nama_devisi' => 'Produksi', 'jabatan' => 'Staff'],
        ['nama_devisi' => 'Umum', 'jabatan' => 'Koordinator',],
        ['nama_devisi' => 'Umum', 'jabatan' => 'Staff',],
        ['nama_devisi' => 'Teknologi', 'jabatan' => 'Koordinator',],
        ['nama_devisi' => 'Teknologi dan Informasi', 'jabatan' => 'Staff',],
        // Tambahkan data devisi lainnya sesuai kebutuhan
    ];

    // Insert data devisi ke tabel 'devisis'
    DB::table('devisis')->insert($devisi);
    }
       
}
