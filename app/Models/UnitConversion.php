<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitConversion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'unit_conversion';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;

    /**
     * Get the from that owns the UnitConversion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'origin_id', 'id');
    }

    /**
     * Get the to that owns the UnitConversion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function to(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'result_id', 'id');
    }
}
