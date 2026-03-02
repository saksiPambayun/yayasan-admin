<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkData extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sk_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nomor_sk',
        'tentang',
        'tanggal_sk',
        'file_sk',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_sk' => 'date',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the file URL.
     */
    public function getFileUrlAttribute()
    {
        return $this->file_sk ? asset('storage/' . $this->file_sk) : null;
    }

    /**
     * Get the file size in KB.
     */
    public function getFileSizeAttribute()
    {
        if ($this->file_sk && file_exists(storage_path('app/public/' . $this->file_sk))) {
            return number_format(filesize(storage_path('app/public/' . $this->file_sk)) / 1024, 2);
        }
        return 0;
    }
}
