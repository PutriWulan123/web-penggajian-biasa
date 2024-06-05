<?php

namespace App\Models;

use App\Models\Pegawai;
use App\Models\Devisi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $primary = 'id';
    protected $guarded = [];
    protected $dates = ['tanggal_bayar'];
    
    // public function pegawais(){
    //     return $this->belongsTo(Penggajian::class, 'id_pegawai','id');
    //    }
    public function pegawais()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai','id');
    }
    public function devisis()
    {
        return $this->belongsTo(Devisi::class, 'id_devisi','id');
    }
}

