<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * Get all of the details for the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(SalesDetail::class, 'sale_id', 'id');
    }

    /**
     * Get the branch that owns the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    /**
     * Get the cashier that owns the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id', 'id');
    }

    /**
     * Get the balance associated with the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balance(): HasOne
    {
        return $this->hasOne(Balance::class, 'sale_id', 'id');
    }
}
