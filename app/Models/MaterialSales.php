<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialSales extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'material_sales';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * Get the balance associated with the MaterialSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balance(): HasOne
    {
        return $this->hasOne(Balance::class, 'material_sale_id', 'id');
    }

    /**
     * Get the cashier that owns the MaterialSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id', 'id');
    }

    /**
     * Get the branch that owns the MaterialSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
