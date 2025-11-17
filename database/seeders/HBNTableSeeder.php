<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HBNTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('hbn')->truncate();

        \DB::table('hbn')->insert([
            [
                'title' => 'Hari Keluarga',
                'date' => '2025-02-15',
                'description' => 'aw aw aw aw',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Hari Tanpa Tembakau Sedunia',
                'date' => '2025-03-31',
                'description' => 'aw aw aw aw',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Idul adha',
                'date' => '2025-06-13',
                'description' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
