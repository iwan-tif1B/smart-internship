<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni
 extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'testimoni';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'mentor_id',
        'content',
    ];

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
