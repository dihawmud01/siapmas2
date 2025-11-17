<?php

namespace App\Observers;

use App\Models\SP;
use Carbon\Carbon;

class SPObserver
{
    /**
     * Handle the SP "created" event.
     */
    public function created(SP $letter): void
    {
        //
    }

    /**
     * Handle the SP "updated" event.
     */
    public function updated(SP $letter): void
    {
        if ($letter->isDirty('generated_at')) {
            $letter->expired_at = $letter->generated_at
                ->copy()
                ->year($letter->end_period)
                ->toDateString();
            $letter->saveQuietly();
        }
    }

    /**
     * Handle the SP "deleted" event.
     */
    public function deleted(SP $letter): void
    {
        //
    }

    /**
     * Handle the SP "restored" event.
     */
    public function restored(SP $letter): void
    {
        //
    }

    /**
     * Handle the SP "force deleted" event.
     */
    public function forceDeleted(SP $letter): void
    {
        //
    }
}