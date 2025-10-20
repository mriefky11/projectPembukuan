<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Spending extends Model
{
    use HasFactory;
    
    protected $table = 'pengeluaran';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'kegiatan_id',
        'kategori_id',
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

    protected $casts = [
        'tanggal' => 'date',
    ];


    public function activity()
    {
        return $this->belongsTo(Activity::class, 'kegiatan_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryCost::class, 'kategori_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
