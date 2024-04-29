<?php

namespace App\Models\ref\Contract;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Contract extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'contracts';
    protected $fillable = [
        'id',
        'contract_number',
        'contract_type_id',
        'contract_name',
        'contract_date',
        'contract_due_date',
        'contract_status',
        'contract_client_id',
        'contract_created_by',
        'contract_updated_by',
        'contract_value'
    ];
    protected $allowedFilters = [
        'id',
        'contract_number',
        'contract_type_id',
        'contract_name',
        'contract_date',
        'contract_due_date',
        'contract_status',
        'contract_client_id',
        'contract_created_by',
        'contract_updated_by',
        'contract_value'
    ];
    protected $allowedSorts = [
        'id',
        'contract_number',
        'contract_type_id',
        'contract_name',
        'contract_date',
        'contract_due_date',
        'contract_status',
        'contract_client_id',
        'contract_created_by',
        'contract_updated_by',
        'contract_value'
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
    
    public function contract()
    {
        return $this->belongsTo(ContractDetail::class, 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'contract_client_id');
    }

}
