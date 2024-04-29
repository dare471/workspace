<?php

namespace App\Models\ref\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ProductCategory extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'product_categories';
    protected $fillable = [
        'id',
        'name',
        'created_by',
        'updated_by',
        'description'
    ];

    protected array $allowedFilters = [
        'id',
        'name',
        'created_by',
        'updated_by',
        'description'
    ];
    protected array $allowedSorts = [
        'id',
        'name',
        'created_by',
        'updated_by',
        'description'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

}
