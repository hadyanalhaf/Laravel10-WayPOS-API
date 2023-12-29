<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unit';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * Get all of the products for the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'main_unit_id', 'id');
    }

    /**
     * Get all of the materials for the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'main_unit_id', 'id');
    }

    /**
     * Get all of the out_conversions for the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function out_conversions(): HasMany
    {
        return $this->hasMany(UnitConversion::class, 'origin_id', 'id');
    }

    /**
     * Get all of the self_conversions for the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function self_conversions(): HasMany
    {
        return $this->hasMany(UnitConversion::class, 'result_id', 'id');
    }

    /**
     * Get all of the material_stock_logs for the Unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function material_stock_logs(): HasMany
    {
        return $this->hasMany(MaterialStockLog::class, 'unit_id', 'id');
    }
}
