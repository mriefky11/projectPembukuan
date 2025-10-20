<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Income extends Model
{
     use HasFactory;

    protected $table = 'pemasukan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'kegiatan_id',
        'tanggal',
        'jumlah',
        'keterangan',
        'created_by',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function activity()
    {
        // pastikan foreign key dan local key sesuai dengan migration
        return $this->belongsTo(Activity::class, 'kegiatan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
