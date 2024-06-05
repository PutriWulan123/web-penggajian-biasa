<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('absensis')->insert([
            'id_pegawai' => '1',
            'id_devisi' => '5',
            'kehadiran' => 'Ijin',
            'tanggal' => '2024-03-03',
        ]);
    }
}

