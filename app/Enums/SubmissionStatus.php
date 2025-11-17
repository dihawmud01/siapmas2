<?php

namespace App\Enums;

enum SubmissionStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('Menunggu Persetujuan'),
            self::APPROVED => __('Disetujui'),
            self::REJECTED => __('Ditolak'),
        };
    }

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }
}
