<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    protected $table = 'cnt_testing_riwayat_pendidikan';
    public $timestamps = false;
    protected $hidden = [] ;
    protected $fillable = [
        'name',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'biodata_id',
    ];
}
