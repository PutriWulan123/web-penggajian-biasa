<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            'nama_pegawai' => 'Putri Wulan Sari',
            'jenis_kelamin' => 'Perempuan',
            'id_devisi' => '5',
            'alamat' => 'Wonosobo',
            'no_telp' => '081217865340',
        ]);
    }
}