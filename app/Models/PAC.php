<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PAC extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'pac';
    protected $fillable = ['pac', 'slug'];

    public function getPACNameAttribute(): string
    {
        return $this->pac;
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->pac);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'pac_id', 'id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class, 'pac_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'pac',
            ],
        ];
    }
}
