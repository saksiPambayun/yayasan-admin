<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'nama',
        'jabatan',
        'divisi',
        'foto_ktp',
        'foto_npwp',
        'status',
        'tanggal_bergabung',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_bergabung' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include active employees.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope a query to only include on-leave employees.
     */
    public function scopeOnLeave($query)
    {
        return $query->where('status', 'cuti');
    }

    /**
     * Scope a query to only include inactive employees.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'nonaktif');
    }

    /**
     * Get the status badge color.
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'aktif' => 'badge-success',
            'cuti' => 'badge-pending',
            'nonaktif' => 'badge-danger',
            default => 'badge-pending',
        };
    }

    /**
     * Get the KTP file URL.
     */
    public function getKtpUrlAttribute()
    {
        return $this->foto_ktp ? asset('storage/' . $this->foto_ktp) : null;
    }

    /**
     * Get the NPWP file URL.
     */
    public function getNpwpUrlAttribute()
    {
        return $this->foto_npwp ? asset('storage/' . $this->foto_npwp) : null;
    }
}
