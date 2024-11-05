<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{

    /**
     * Boot the BelongsToUser trait for a class.
     *
     * @return void
     */
    public static function bootBelongsToUser()
    {
        static::addGlobalScope('belongToUser', function (Builder $builder) {
            $builder->when(Auth::user()?->id, function ($query) {
                $query->where((new static)->getTable() . '.' . self::getUserIdColumn(), Auth::user()?->id);
            });
        });
    }

    /**
     * Get the name of the "user id" column.
     *
     * @return string
     */
    static public function getUserIdColumn(): string
    {
        return defined(static::class . '::USER_ID') ? static::USER_ID : 'user_id';
    }

    /**
     * Get the user that owns the model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
