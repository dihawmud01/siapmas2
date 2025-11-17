<?php

namespace App\Models;

use App\Enums\SubmissionStatus;
use biladina\hijridatetime\HijriDateTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SP extends Model
{
    use HasFactory;

    protected $table = 'sp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (! $model->id) {
                $model->id = preg_replace('/[^0-9]/', '', md5(Str::uuid()->toString()));
            }
        });
    }

    protected $fillable = [
        'type',
        'user_id',
        'start_period',
        'end_period',
        'letter_number',
        'event_date',
        'event_location',
        'mwc_letter_number',
        'protectors',
        'advisors',
        'chairman',
        'vice_chairmen',
        'secretary',
        'vice_secretaries',
        'treasurer',
        'vice_treasurers',
        'organization_department_coordinator',
        'organization_department_members',
        'cadre_department_coordinator',
        'cadre_department_members',
        'dakwah_department_coordinator',
        'dakwah_department_members',
        'culture_department_coordinator',
        'culture_department_members',
        'economy_institution_director',
        'economy_institution_members',
        'press_institution_director',
        'press_institution_members',
        'brigade_institution_director',
        'brigade_institution_members',
        'status',
        'generated_at',
        'expired_at',
    ];

    protected $casts = [
        'status' => SubmissionStatus::class,
        'protectors' => 'array',
        'advisors' => 'array',
        'vice_chairmen' => 'array',
        'vice_secretaries' => 'array',
        'vice_treasurers' => 'array',
        'organization_department_members' => 'array',
        'cadre_department_members' => 'array',
        'dakwah_department_members' => 'array',
        'culture_department_members' => 'array',
        'economy_institution_members' => 'array',
        'press_institution_members' => 'array',
        'brigade_institution_members' => 'array',
        'created_at' => 'datetime',
    ];

    protected $appends = ['formatted_letter_submission_date'];

    public function getFormattedLetterSubmissionDateAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->created_at)->isoFormat('dddd, D MMMM YYYY');
    }

    public function getFormattedEventDateAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->event_date)->isoFormat('dddd, D MMMM YYYY');
    }

    public function getFormattedEventDateWithoutDayAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->event_date)->isoFormat('D MMMM YYYY');
    }

    public function getFormattedApprovedDateAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->updated_at)->isoFormat('dddd, D MMMM YYYY') .
            ' | ' .
            Carbon::parse($this->updated_at)->isoFormat('HH:mm') .
            ' WIB';
    }

    public function getFormattedExpiredDateAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->expired_at)->isoFormat('D MMMM YYYY');
    }

    public function getFormattedGeneratedGeorgiaDateAttribute(): string
    {
        Carbon::setLocale('id');

        return Carbon::parse($this->generated_at)->isoFormat('D MMMM YYYY') . ' M';
    }

    public function getFormattedGeneratedHijriDateAttribute(): string
    {
        $hijri = \IntlDateFormatter::create(
            'id_SA@calendar=islamic',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'Asia/Riyadh',
            \IntlDateFormatter::TRADITIONAL,
            'd MMMM yyyy',
        );

        return $hijri->format(Carbon::parse($this->generated_at)->timestamp) . ' H';
    }

    public function files(): HasMany
    {
        return $this->hasMany(SPSubmissionFile::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}