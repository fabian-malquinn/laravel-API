<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'cnt_testing_biodata';
    public $timestamps = false;
    protected $hidden = [] ;
    protected $fillable = [
        'name',
        'fullname',
        'tanggal_lahir',
        'umur',
        'anak', 
        'foto',
        'jenis_kelamin',
        'pendidikan_ids',
        'jurusan_ids',
        'riwayat_pendidikan_ids',
        'riwayat_pendidikan_count'
    ];
}
