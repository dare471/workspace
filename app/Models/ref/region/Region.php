<?php

namespace App\Models\ref\region;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // Добавьте этот use, чтобы указать Builder


class Region extends Model
{
    use HasFactory;
    protected $table = 'region';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'te',
        'ab',
        'cd',
        'ef',
        'hij',
        'k',
        'kaz_name',
        'rus_name',
        'nn'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
    public function scopeCd(Builder $query, $code)
    {
        $region = $query->where('cd', $code);
        return $region;
    }

}
