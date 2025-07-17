<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinician extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'location',
        'languages',
        'supervising_clinician_id',
        'status',
        'is_archived',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'languages' => 'array',
        'is_archived' => 'boolean',
    ];

    /**
     * Get the supervising clinician (self-referencing relationship).
     */
    public function supervisingClinician()
    {
        return $this->belongsTo(self::class, 'supervising_clinician_id');
    }

    /**
     * Get the clinicians that are supervised by this clinician.
     */
    public function supervisees()
    {
        return $this->hasMany(self::class, 'supervising_clinician_id');
    }

    /**
     * Get the supervisor (self-referencing relationship).
     */
    public function supervisor()
    {
        return $this->belongsTo(self::class, 'supervising_clinician_id');
    }

    /**
     * Accessor to get languages as a comma-separated string.
     */
    public function getLanguagesListAttribute()
    {
        return is_array($this->languages) ? implode(', ', $this->languages) : '';
    }

    /**
     * Scope to filter by status and role.
     */
    public function scopeStatusRole($query, $status = null, $role = null)
    {
        if ($status) {
            $query->where('status', $status);
        }
        if ($role) {
            $query->where('role', $role);
        }
        return $query;
    }
}
