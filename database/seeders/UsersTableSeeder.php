<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('users')->delete();

        User::factory()->createMany([
            [
                'name' => 'Super Admin',
                'role_id' => 1,
                'bio' => 'Super Admin Account',
                'username' => 'superadmin',
                'slug' => 'superadmin',
                'email' => 'superadmin@mail.com',
                'check' => true,
            ],
            [
                'name' => 'Admin PC',
                'role_id' => 2,
                'bio' => 'Admin PC Account',
                'username' => 'adminpc',
                'slug' => 'adminpc',
                'email' => 'adminpc@mail.com',
                'check' => true,
            ],
            [
                'name' => 'KOMISARIAT UNU PURWOKERTO',
                'role_id' => 3,
                'bio' => 'KOMISARIAT UNU PURWOKERTO Account',
                'username' => 'komsatunupwt',
                'slug' => 'komsatunupwt',
                'email' => 'komsatunupwt@mail.com',
                'check' => true,
                'pac_id' => 28,
            ],
            [
                'name' => 'KOMISARIAT UIN SAIZU PURWOKERTO',
                'role_id' => 3,
                'bio' => 'KOMISARIAT UIN SAIZU PURWOKERTO Account',
                'username' => 'komsatuinsaizupwt',
                'slug' => 'komsatuinsaizupwt',
                'email' => 'komsatuinsaizupwt@mail.com',
                'check' => true,
                'pac_id' => 29,
            ],
        ]);

        $pacData = [
            ['pac' => 'BATURRADEN', 'slug' => 'baturraden'],
            ['pac' => 'CILONGOK', 'slug' => 'cilongok'],
            ['pac' => 'KEDUNGBANTENG', 'slug' => 'kedungbanteng'],
            ['pac' => 'KARANGLEWAS', 'slug' => 'karanglewas'],
            ['pac' => 'PURWOJATI', 'slug' => 'purwojati'],
            ['pac' => 'PURWOKERTO BARAT', 'slug' => 'purwokertobarat'],
            ['pac' => 'PURWOKERTO TIMUR', 'slug' => 'purwokertotimur'],
            ['pac' => 'PURWOKERTO UTARA', 'slug' => 'purwokertoutara'],
            ['pac' => 'PURWOKERTO SELATAN', 'slug' => 'purwokertoselatan'],
            ['pac' => 'SUMBANG', 'slug' => 'sumbang'],
            ['pac' => 'SOKARAJA', 'slug' => 'sokaraja'],
            ['pac' => 'KEMBARAN', 'slug' => 'kembaran'],
            ['pac' => 'TAMBAK', 'slug' => 'tambak'],
            ['pac' => 'SOMAGEDE', 'slug' => 'somagede'],
            ['pac' => 'BANYUMAS', 'slug' => 'banyumas'],
            ['pac' => 'KEMRANJEN', 'slug' => 'kemranjen'],
            ['pac' => 'GUMELAR', 'slug' => 'gumelar'],
            ['pac' => 'AJIBARANG', 'slug' => 'ajibarang'],
            ['pac' => 'PEKUNCEN', 'slug' => 'pekuncen'],
            ['pac' => 'WANGON', 'slug' => 'wangon'],
            ['pac' => 'RAWALO', 'slug' => 'rawalo'],
            ['pac' => 'JATILAWANG', 'slug' => 'jatilawang'],
            ['pac' => 'KEBASEN', 'slug' => 'kebasen'],
            ['pac' => 'PATIKRAJA', 'slug' => 'patikraja'],
            ['pac' => 'KALIBAGOR', 'slug' => 'kalibagor'],
            ['pac' => 'LUMBIR', 'slug' => 'lumbir'],
            ['pac' => 'SUMPIUH', 'slug' => 'sumpiuh'],
            ['pac' => 'KOMISARIAT UNU PURWOKERTO', 'slug' => 'unu'],
            ['pac' => 'KOMISARIAT UIN SAIZU PURWOKERTO', 'slug' => 'uinsaizu'],
        ];

        User::factory()
            ->count(count($pacData))
            ->state(
                new Sequence(
                    fn ($sequence) => [
                        'name' => 'PAC ' . $pacData[$sequence->index]['pac'],
                        'pac_id' => $sequence->index + 1,
                        'role_id' => 3,
                        'bio' => 'PAC ' . $pacData[$sequence->index]['pac'],
                        'username' => 'pac' . $pacData[$sequence->index]['slug'],
                        'slug' => 'pac' . $pacData[$sequence->index]['slug'],
                        'email' => 'pac' . $pacData[$sequence->index]['slug'] . '@mail.com',
                        'check' => true,
                    ],
                ),
            )
            ->create();
    }
}
