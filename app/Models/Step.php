<?php

namespace App\Models;

use App\Enum\StepStatusEnum;
use Illuminate\Database\Eloquent\Model;

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
}
