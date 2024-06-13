<?php

namespace App\Models;

use App\Models\Pegawai;
use App\Models\Devisi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $primary = 'id';
    protected $table = 'absensis';
    // protected $guarded = [];
    protected $fillable = [
        'id_pegawai',
        'id_devisi',
        'kehadiran',
        'tanggal',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function devisi()
    {
        return $this->belongsTo(Devisi::class, 'id_devisi', 'id');
    }
}