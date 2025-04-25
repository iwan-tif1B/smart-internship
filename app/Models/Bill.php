<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public const belum_lunas = "Belum Lunas";
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bill';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_bill',            // From your migration
        'time_order',           // From your migration
        'queque_session_id',  // From your migration
        'id_user',  // From your migration
        'note',  // From your migration
        'total',  // From your migration
        'details',  // From your migration
        'created_by',      // User tracking field
        'updated_by',      // User tracking field
        'deleted_by',      // User tracking field
        'created_at',      // Timestamp field
        'updated_at',      // Timestamp field
        'deleted_at',      // Soft delete field
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function quque_session()
    {
        return $this->belongsTo(QuequeSession::class, 'queque_session_id', 'id');
    }
}
