<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'periode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'tanggal_selesai',
        'is_active',
    ];


    public function periode()
    {
        return $this->belongsTo(Kategori::class, 'jenis_buku', 'id');
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
