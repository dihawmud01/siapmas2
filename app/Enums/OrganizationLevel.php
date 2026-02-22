<?php

namespace App\Enums;

enum OrganizationLevel: string
{
    case PAC = 'PAC';
    case PR = 'PR';
    case PK = 'PK';

    public function label(): string
    {
        return match ($this) {
            self::PAC => 'Pimpinan Anak Cabang',
            self::PR => 'Pimpinan Ranting',
            self::PK => 'Pimpinan Komisariat',
        };
    }

    public function shortLabel(): string
    {
        return match ($this) {
            self::PAC => 'PAC',
            self::PR => 'PR',
            self::PK => 'PK',
        };
    }

    public function eventTypeName(): string
    {
        return match ($this) {
            self::PAC => 'Konferensi Anak Cabang',
            self::PR => 'Rapat Anggota Ranting',
            self::PK => 'Rapat Anggota Komisariat',
        };
    }

    public function brigadeLabel(): string
    {
        return match ($this) {
            self::PAC => 'DEWAN KOORDINASI ANAK CABANG (DKAC)',
            self::PR => 'DEWAN KOORDINASI RANTING (DKR)',
            self::PK => 'DEWAN KOORDINASI KOMISARIAT (DKK)',
        };
    }

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }
}
