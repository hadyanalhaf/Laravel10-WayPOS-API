<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balance';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * Get the creator that owns the Balance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'create_by', 'id');
    }

    /**
     * Get the material_sale that owns the Balance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material_sales(): BelongsTo
    {
        return $this->belongsTo(MaterialSales::class, 'material_sale_id', 'id');
    }

    /**
     * Get the sales that owns the Balance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sales(): BelongsTo
    {
        return $this->belongsTo(Sales::class, 'sale_id', 'id');
    }
}
