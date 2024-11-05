<?php

namespace App\Models;

use App\Enum\RessourceTypeEnum;
use Illuminate\Database\Eloquent\Model;

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
}
