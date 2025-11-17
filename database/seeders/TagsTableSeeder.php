<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tags')->delete();

        \DB::table('tags')->insert([
            [
                'title' => 'pc-ipnu-ippnu-banyumas',
                'slug' => 'pc-ipnu-ippnu-banyumas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'lorem-ipsum',
                'slug' => 'lorem-ipsum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'lorem-ipsum-2',
                'slug' => 'lorem-ipsum-2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
