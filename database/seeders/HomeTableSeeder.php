<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HomeTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('home')->delete();

        \DB::table('home')->insert([
            0 => [
                'id' => 1,
                'title' => 'PC IPNU IPPNU Banyumas',
                'description' => 'Cabang Kota Bandung',
                'link' => 'https://www.youtube.com/',
                'img' => 'waduh.jpeg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            1 => [
                'id' => 2,
                'title' => 'Tri Moto PC IPNU IPPNU Banyumas',
                'description' => 'Dzikir, Pikir, Amal Shaleh',
                'link' => 'https://www.instagram.com/',
                'img' => 'news-2.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
