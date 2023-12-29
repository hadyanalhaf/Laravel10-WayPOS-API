<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'partner';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = true;

    /**
     * Get all of the branchs for the Partner
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class, 'partner_id', 'id');
    }
}
