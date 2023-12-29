<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Brainlet\LaravelConvertTimezone\Traits\ConvertTZ;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active',
        'branch_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the branch that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    /**
     * Get all of the material_sales for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function material_sales(): HasMany
    {
        return $this->hasMany(MaterialSales::class, 'cashier_id', 'id');
    }

    /**
     * Get all of the sales for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class, 'cashier_id', 'id');
    }

    /**
     * Get all of the balances for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function balances(): HasMany
    {
        return $this->hasMany(Balance::class, 'created_by', 'id');
    }
}
