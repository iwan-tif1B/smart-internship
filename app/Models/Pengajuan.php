<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengajuan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'posisi_id',
        'periode_id',
        'is_active',
        'status_administrasi',
        'status_tes_kemampuan',
        'status_wawancara',
        'status',
        'tanggal_wawancara',
        'tanggal_awal_tes_kemampuan',
        'tanggal_akhir_tes_kemampuan',
        'link_wawancara',
        'soal_tes_kemampuan',
        'jawaban_tes_kemampuan',
    ];


    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'posisi_id', 'id');
    }
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id', 'id');
    }

    public function nama()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Buku extends Model
// {
//     // use HasFactory, Notifiable, HasApiTokens;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */
//     protected $table = 'buku';

//     protected $fillable = [
//         'judul',
//         'penulis',
//         'jenis_buku',
//         'tahun_terbit',
//         'created_at',
//         'updated_at',
//     ];

//     public function jenis()
//     {
//         return $this->belongsTo(Kategori::class, 'jenis_buku','id');
//     }
// }
