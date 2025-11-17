<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    public function label(): string
    {
        return match ($this) {
            self::MALE => __('Laki-laki'),
            self::FEMALE => __('Perempuan'),
        };
    }

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getLabels(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($gender) => [$gender->value => $gender->label()])
            ->toArray();
    }
}
