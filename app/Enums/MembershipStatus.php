<?php

namespace App\Enums;

enum MembershipStatus: string
{
    case PAC_MEMBER = 'pac_member';
    case PC_MEMBER = 'pc_member';

    public function label(): string
    {
        return match ($this) {
            self::PAC_MEMBER => 'Anggota PAC',
            self::PC_MEMBER => 'Anggota PC',
        };
    }

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getLabels(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($cadreLevel) => [$cadreLevel->value => $cadreLevel->label()])
            ->toArray();
    }
}
