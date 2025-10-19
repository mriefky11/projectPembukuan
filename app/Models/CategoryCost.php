<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryCost extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $table = 'kategori_biaya';

    protected $fillable =[
        'nama_kategori',
        'jenis_biaya',
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
