<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sale_details';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * Get the sales that owns the SalesDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sales(): BelongsTo
    {
        return $this->belongsTo(Sales::class, 'sale_id', 'id');
    }

    /**
     * Get the product that owns the SalesDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
