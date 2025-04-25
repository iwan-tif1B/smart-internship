<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent_session extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rent_session';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name_session',            // From your migration
        'start_session',           // From your migration
        'end_session',  // From your migration
        'masterps_id',  // From your migration
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

    public function master_ps()
    {
        return $this->belongsTo(Masterps::class, 'masterps_id', 'id');
    }
    public function masters_ps()
    {
        return $this->hasMany(Masterps::class, 'masterps_id', 'id');
    }
    public function details_session()
    {
        return $this->belongsTo(DetailsSession::class, 'details_session_id', 'id');
    }
    public function detailsSessions()
    {
        return $this->hasMany(DetailsSession::class);
    }

    // Relasi ke Masterps
    public function masterps()
    {
        return $this->belongsTo(Masterps::class, 'masterps_id');
    }
}
