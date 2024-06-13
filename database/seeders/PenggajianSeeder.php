<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PenggajianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penggajians')->insert([
            'id_pegawai' => '1',
            // 'id_devisi' => '5',
            'periode' => '2024-03',
            'makan' => '15000',
            'transportasi' => '15000',
            'tgl_penggajian' => '2024-03-03',
        ]);

    }
}
