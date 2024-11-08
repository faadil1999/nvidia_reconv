<?php

namespace App\Models;

use App\Enum\StepStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Step extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'career_path_id',
        'title',
        'description',
        'order',
        'status'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => StepStatusEnum::class,
        ];
    }

    /***************************Relationship********************** */

    /**
     * Function for getting the owner of this step
     *
     * @return BelongsTo
     *
     */
    public function careerPath(): BelongsTo
    {
        return $this->belongsTo(CareerPath::class);
    }

    /**
     * Function for getting all ressources of this step
     *
     * @return HasMany
     *
     */
    public function ressources(): HasMany
    {
        return $this->hasMany(Ressource::class);
    }
}
