<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $name
     * @property string|null $phone
     * @property string $email
     * @property string $password
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     *
     * @mixin \Eloquent
     */

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }
}
