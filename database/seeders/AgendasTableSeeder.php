<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgendasTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('agendas')->truncate();

        \DB::table('agendas')->insert([
            [
                'title' => 'Pelantikan Administrator Komisariat',
                'organizer' => 'KOMISARIAT UNU PURWOKERTO',
                'date' => '2025-02-16 13:00:00',
                'place' => 'Gd. PascaSarjana Lt 1',
                'category' => 'Formal',
                'total_participants' => '70',
                'target' => 'ya nda tau',
                'evaluation' => 'konsumsi di perbaiki lagi',
                'status' => 1,
                'pamphlet' => 'waduh.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Taman Baca',
                'organizer' => 'PAC BATURRADEN',
                'date' => '2025-02-15 16:00:00',
                'place' => 'Rumput Surga',
                'category' => 'Nonformal',
                'total_participants' => '21',
                'target' => 'ya nda tau',
                'evaluation' => '231',
                'status' => 1,
                'pamphlet' => 'waduh.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Harlah PC IPNU IPPNU Banyumas',
                'organizer' => 'KOMISARIAT UIN SAIZU PURWOKERTO',
                'date' => '2025-02-14T00:00',
                'place' => 'Solo',
                'category' => 'Nonformal',
                'total_participants' => '200',
                'target' => '50',
                'evaluation' => 'konsumsi di perbaiki lagi',
                'status' => 1,
                'pamphlet' => 'waduh.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ngecor Jalan',
                'organizer' => 'PAC CILONGOK',
                'date' => '2023-08-23 17:13:00',
                'place' => 'Jl. Soekarno Hatta',
                'category' => 'Nonformal',
                'total_participants' => '200',
                'target' => '50',
                'evaluation' => 'konsumsi di perbaiki lagi',
                'status' => 0,
                'pamphlet' => 'waduh.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
