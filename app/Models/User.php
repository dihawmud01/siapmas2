<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravolt\Indonesia\Models\Province;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function pac(): BelongsTo
    {
        return $this->belongsTo(PAC::class, 'pac_id', 'id');
    }

    public function letterOfValidationSubmissions(): HasMany
    {
        return $this->hasMany(SP::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Province::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'username',
            ],
        ];
    }

    public function letters()
    {
        return $this->hasMany(Letter::class, 'user_id');
    }

}
