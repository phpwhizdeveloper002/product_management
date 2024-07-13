<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'price',
        'quantity',
        'status',
        'company_name',
        'city',
        'country',
        'created_by'
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id', 'created_by');
    }
}
