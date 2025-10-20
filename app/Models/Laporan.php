<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Laporan extends Model
{
    protected $table = 'laporan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'kegiatan_id',
        'periode',
        'total_pemasukan',
        'total_pengeluaran_langsung',
        'total_pengeluaran_tidak_langsung',
        'total_pengeluaran',
        'saldo',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($model){
            if(empty($model->{$model->getKeyName()})){
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function kegiatan()
    {
        return $this->belongsTo(Activity::class, 'kegiatan_id', 'id');
    }
}
