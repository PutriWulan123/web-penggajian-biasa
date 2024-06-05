<?php

namespace App\Models;

use App\Models\Pegawai;
use App\Models\Penggajian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devisi extends Model
{
    use HasFactory;

    //  protected $guarded = [];
    // protected $tabel = "devisis";
    protected $primarykey = "id";
    protected $fillable = ['id', 'nama_devisi'];

    protected $table = 'devisis';

    // Relasi one-to-many dengan model Pegawai
    public function pegawais()
    {
        return $this->hasMany(Pegawai::class, 'devisi_id');
    }
    public function penggajians()
    {
        return $this->hasOne(Penggajian::class);
    }
}
