<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Function for getting the belonging skills
     *
     * @return BelongsToMany
     */
    public function careerPaths(): BelongsToMany
    {
        return $this->belongsToMany(CareerPath::class);
    }
}
