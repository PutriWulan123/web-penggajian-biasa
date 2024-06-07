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
    protected $guarded = [];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'id_pegawai','id');
    }

    public function devisis()
    {
        return $this->belongsTo(Devisi::class, 'id_devisi','id');
    }
}
