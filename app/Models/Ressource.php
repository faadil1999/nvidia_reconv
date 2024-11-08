<?php

namespace App\Models;

use App\Enum\RessourceTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ressource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'type',
        'step_id'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => RessourceTypeEnum::class,
        ];
    }

    /*************************Relationship************************ */

    /**
     * Function for getting the step that belongs to ressource
     *
     * @return BelongsTo
     */
    public function step(): BelongsTo
    {
        return $this->belongsTo(Step::class);
    }
}
