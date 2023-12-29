<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialStockLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'material_stock_log';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * Get the unit that owns the MaterialStockLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    /**
     * Get the material that owns the MaterialStockLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

    /**
     * Get the transactions associated with the MaterialStockLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(MaterialSalesDetail::class, 'material_stock_log_id', 'id');
    }
}
