<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;
    use AsSource;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'description'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

}
