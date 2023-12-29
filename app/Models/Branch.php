<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'branch';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * Get the owner that owns the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

    /**
     * The categories that belong to the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'branch_category', 'branch_id', 'category_id');
    }

    /**
     * The products that belong to the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'branch_product', 'branch_id', 'product_id');
    }

    /**
     * Get all of the material_sales for the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function material_orders(): HasMany
    {
        return $this->hasMany(MaterialSales::class, 'branch_id', 'id');
    }

    /**
     * Get all of the sales for the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class, 'branch_id', 'id');
    }

    /**
     * Get all of the users for the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'branch_id', 'id');
    }
}
