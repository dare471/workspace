<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\WhereDate;
use App\Models\ref\region\Region;

class Client extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'status',
        'client_type',
        'email',
        'bin',
        'region_id',
        'district_id',
        'birthday',
        'assesment',
        'service_id'
    ];
    protected $allowedSort = [
        'name',
        'last_name',
        'phone',
        'status',
        'client_type',
        'email',
        'bin',
        'region_id',
        'district_id',
        'birthday',
        'assesment',
        'service_id'
    ];
    protected $allowedFilters = [
        'phone'=> Like::class,
        'bin' => Like::class,
        'name' => Like::class,
        'last_name' => Like::class,
        'email' => Like::class,
        'birthday' => WhereDate::class,
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
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
}
