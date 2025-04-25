<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailsSession extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'details_session';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name_playstation',            // From your migration
        'note',           // From your migration
        'rent_session_id',  // From your migration
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
    // public function rent_session()
    // {
    //     return $this->hasMany(Rent_session::class, 'rent_session_id', 'id');
    // }
    public function rent_session()
    {
        return $this->hasMany(Rent_session::class, 'rent_session_id', 'id');
    }
    public function rentSession()
    {
        return $this->belongsTo(Rent_session::class, 'rent_session_id');
    }
}
