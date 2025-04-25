<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuequeSession extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public const belum_booked = '0';
    protected $table = 'queque_session';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',            // From your migration
        'date',           // From your migration
        'details_rent_playstation_id',  // From your migration
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
    public function detail_session()
    {
        return $this->belongsTo(DetailsSession::class, 'details_rent_playstation_id', 'id');
    }
}
