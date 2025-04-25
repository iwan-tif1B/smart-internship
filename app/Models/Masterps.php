<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masterps extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_ps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',            // From your migration
        'price',           // From your migration
        'additional_fee',  // From your migration
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
    // Relasi ke RentSession
    public function rentSessions()
    {
        return $this->hasMany(Rent_session::class);
    }
}
