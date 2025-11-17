<?php

namespace App\Enums;

enum FileCategory: string
{
    case DOCUMENTATION = 'documentation';
    case REQUEST_LETTER = 'request_letter';
    case MWC_RECOMMENDATION = 'mwc_recommendation';
    case PAC_RECOMMENDATION = 'pac_recommendation';
    case ELECTION_REPORT = 'election_report';
    case FORMATION_REPORT = 'formation_report';
    case MANAGEMENT_STRUCTURE = 'management_structure';
    case ID_CV_PHOTO_CERTIFICATE = 'id_cv_photo_certificate';

    public function label(): string
    {
        return match ($this) {
            self::DOCUMENTATION => __('DOKUMENTASI PELAKSANAAN KONFERANCAB/RAPAT ANGGOTA'),
            self::REQUEST_LETTER => __('SURAT PERMOHONAN PENGESAHAN KEPADA PC IPNU KABUPATEN BANYUMAS'),
            self::MWC_RECOMMENDATION => __('SURAT REKOMENDASI DARI MWC NU/PR NU SETEMPAT'),
            self::PAC_RECOMMENDATION => __('SURAT REKOMENDASI PAC SETEMPAT'),
            self::ELECTION_REPORT => __('BERITA ACARA PEMILIHAN KETUA HASIL KONFERANCAB/RAPAT ANGGOTA'),
            self::FORMATION_REPORT => __('BERITA ACARA PENYUSUNAN KEPENGURUSAN OLEH TIM FORMATUR'),
            self::MANAGEMENT_STRUCTURE => __('SUSUNAN PENGURUS LENGKAP'),
            self::ID_CV_PHOTO_CERTIFICATE => __(
                'SCAN KTP, CV, PAS FOTO, SERTIFIKAT KADERIASI (KETUA, SEKRETARIS & BENDAHARA)',
            ),
        };
    }

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }
}
