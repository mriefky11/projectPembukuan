<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'kegiatan';

    protected $fillable =[
        'name',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
