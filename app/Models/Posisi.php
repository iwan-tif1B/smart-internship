<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posisi
extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posisi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nama',
        'total_kuota',
        'kuota_tersedia',
        'persyaratan',
        'deskripsi',
        'is_active',
        'status',
    ];


    // public function jenis()
    // {
    //     return $this->belongsTo(Kategori::class, 'jenis_buku', 'id');
    // }
}
