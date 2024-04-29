<?php

namespace App\Models\ref\Contract;

use App\Models\ref\product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class ContractDetail extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'contract_details';
    protected $fillable = [
        'id',
        'contract_id',
        'product_id',
        'count',
        'price',
    ];

    protected $allowedFilters = [
        'id',
        'contract_id',
        'product_id',
        'count',
        'price',
    ];
    protected $allowedSorts = [
        'id',
        'contract_id',
        'product_id',
        'count',
        'price',
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

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

}
