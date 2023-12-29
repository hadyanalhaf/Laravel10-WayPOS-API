<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialSalesDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'material_sale_details';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * Get the material that owns the MaterialSalesDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

    /**
     * Get the material_sale that owns the MaterialSalesDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material_sale(): BelongsTo
    {
        return $this->belongsTo(MaterialSales::class, 'material_sale_id', 'id');
    }

    /**
     * Get the stock_logs that owns the MaterialSalesDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock_logs(): BelongsTo
    {
        return $this->belongsTo(MaterialStockLog::class, 'material_stock_log_id', 'id');
    }
}
