<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktaWakaf extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'akta_wakaf';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_sertifikat',
        'nazhir',
        'lokasi_tanah',
        'luas_tanah',
        'file_sertifikat',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the file URL.
     */
    public function getFileUrlAttribute()
    {
        return $this->file_sertifikat ? asset('storage/' . $this->file_sertifikat) : null;
    }

    /**
     * Get the file size in KB.
     */
    public function getFileSizeAttribute()
    {
        if ($this->file_sertifikat && file_exists(storage_path('app/public/' . $this->file_sertifikat))) {
            return number_format(filesize(storage_path('app/public/' . $this->file_sertifikat)) / 1024, 2);
        }
        return 0;
    }
}
