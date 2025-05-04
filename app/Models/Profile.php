<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    /**
     * Atributos masivos asignables.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'birthday',
        'bio',
        'avatar',
    ];

    /**
     * Relación inversa a User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
