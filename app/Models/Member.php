<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\MembershipStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'address',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'is_makesta',
        'is_lakmud',
        'is_lakut',
        'makesta_year',
        'lakmud_year',
        'lakut_year',
        'is_diklatama',
        'is_diklatnas',
        'is_diklatmad',
        'is_latinpel',
        'phone',
        'photo',
        'pac_id',
        'membership_status',
    ];

    protected $casts = [
        'gender' => Gender::class,
        'non_formal_cadre_levels' => 'array',
        'is_makesta' => 'boolean',
        'is_lakmud' => 'boolean',
        'is_lakut' => 'boolean',
        'is_diklatama' => 'boolean',
        'is_diklatnas' => 'boolean',
        'is_diklatmad' => 'boolean',
        'is_latinpel' => 'boolean',
        'membership_status' => MembershipStatus::class,
    ];

    public function getFormattedDateOfBirthAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->date_of_birth)->isoFormat('D MMMM YYYY');
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')->orWhereIn('pac_id', function ($subQuery) use ($search) {
                $subQuery
                    ->select('id')
                    ->from('pac')
                    ->where('pac', 'like', '%' . $search . '%');
            });
        });
    }

    public function getCadreLevelAttribute()
    {
        if ($this->is_lakut) return 'Lakut';
        if ($this->is_lakmud) return 'Lakmud';
        if ($this->is_makesta) return 'Makesta';
        if ($this->is_diklatama) return 'diklatama';
        if ($this->is_diklatnas) return 'diklatnas';
        if ($this->is_diklatmad) return 'diklatmad';
        if ($this->is_latinpel) return 'diklatmad';
        return 'Belum Makesta';
    }
    
    public function pac()
    {
        return $this->belongsTo(PAC::class, 'pac_id');
    }
}
