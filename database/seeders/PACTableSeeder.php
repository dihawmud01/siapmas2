<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PACTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pac')->delete();

        \DB::table('pac')->insert([
            [
                'pac' => 'BATURRADEN',
                'slug' => 'baturraden',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'CILONGOK',
                'slug' => 'cilongok',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'KEDUNGBANTENG',
                'slug' => 'kedungbanteng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'KARANGLEWAS',
                'slug' => 'karanglewas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'PURWOJATI',
                'slug' => 'purwojati',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'PURWOKERTO BARAT',
                'slug' => 'purwokerto-barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'PURWOKERTO TIMUR',
                'slug' => 'purwokerto-timur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'PURWOKERTO UTARA',
                'slug' => 'purwokerto-utara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'PURWOKERTO SELATAN',
                'slug' => 'purwokerto-selatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'SUMBANG',
                'slug' => 'sumbang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'SOKARAJA',
                'slug' => 'sokaraja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'KEMBARAN',
                'slug' => 'kembaran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'TAMBAK',
                'slug' => 'tambak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'SOMAGEDE',
                'slug' => 'somagede',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'BANYUMAS',
                'slug' => 'banyumas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'KEMRANJEN',
                'slug' => 'kemranjen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'GUMELAR',
                'slug' => 'gumelar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'AJIBARANG',
                'slug' => 'ajibarang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'PEKUNCEN',
                'slug' => 'pekuncen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'WANGON',
                'slug' => 'wangon',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'RAWALO',
                'slug' => 'rawalo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'JATILAWANG',
                'slug' => 'jatilawang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'KEBASEN',
                'slug' => 'kebasen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'PATIKRAJA',
                'slug' => 'patikraja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'KALIBAGOR',
                'slug' => 'kalibagor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'LUMBIR',
                'slug' => 'lumbir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'SUMPIUH',
                'slug' => 'sumpiuh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'KOMISARIAT UNU PURWOKERTO',
                'slug' => 'unu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pac' => 'KOMISARIAT UIN SAIZU PURWOKERTO',
                'slug' => 'uin-saizu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
