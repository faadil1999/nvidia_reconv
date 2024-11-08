<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CareerPath extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'career_id',
        'introduction',
        'conclusion',
        'comment',
    ];


    /**
     * Get all steps of career path
     *
     * @return HasMany
     *
     */
    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }
}
