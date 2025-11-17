<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\FileCategory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SPSubmissionFile extends Model
{
    protected $table = 'sp_submission_files';

    protected $fillable = ['type', 'category', 'attachment', 'sp_id'];

    protected $casts = [
        'category' => FileCategory::class,
    ];

    public function sp(): BelongsTo
    {
        return $this->belongsTo(SP::class);
    }
}
