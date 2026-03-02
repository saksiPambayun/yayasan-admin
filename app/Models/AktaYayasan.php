<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktaYayasan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'akta_yayasan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_akta',
        'tanggal_akta',
        'notaris',
        'file_akta',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_akta' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the file URL.
     */
    public function getFileUrlAttribute()
    {
        return $this->file_akta ? asset('storage/' . $this->file_akta) : null;
    }

    /**
     * Get the file size in KB.
     */
    public function getFileSizeAttribute()
    {
        if ($this->file_akta && file_exists(storage_path('app/public/' . $this->file_akta))) {
            return number_format(filesize(storage_path('app/public/' . $this->file_akta)) / 1024, 2);
        }
        return 0;
    }
}
