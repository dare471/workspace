<?php

namespace App\Models\ref\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use \App\Models\ref\product\ProductCategory;

class Product extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'products';
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'description',
        'created_by',
        'updated_by',
    ];
    protected array $allowedFilters = [
        'id',
        'name',
        'category_id',
        'description',
        'created_by',
        'updated_by'
    ];
    protected array $allowedSorts = [
        'id',
        'name',
        'category_id',
        'description',
        'created_by',
        'updated_by',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function category(){
       return $this->belongsTo(ProductCategory::class,  'id');
    }
}
