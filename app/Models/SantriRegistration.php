<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SantriRegistration extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'santri_registrations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'nisn',
        'asal_sekolah',
        'tanggal_lahir',
        'alamat',
        'email',
        'no_wali',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include pending registrations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include accepted registrations.
     */
    public function scopeAccepted($query)
    {
        return $query->where('status', 'diterima');
    }

    /**
     * Scope a query to only include rejected registrations.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'ditolak');
    }

    /**
     * Get the status badge color.
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'pending' => 'badge-pending',
            'diterima' => 'badge-success',
            'ditolak' => 'badge-danger',
            default => 'badge-pending',
        };
    }
}
