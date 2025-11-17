<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('comments')->truncate();

        \DB::table('comments')->insert([
            [
                'user_id' => '1',
                'news_id' => '2',
                'comment' => 'Kereen. Tumbuh subur pergerakan 🌹',
                'created_at' => '2023-06-02 00:08:24',
                'updated_at' => '2023-06-02 00:08:24',
            ],
            [
                'user_id' => '2',
                'news_id' => '2',
                'comment' => 'mantap sahabat',
                'created_at' => '2023-06-04 11:58:22',
                'updated_at' => '2023-06-04 11:58:22',
            ],
        ]);
    }
}
