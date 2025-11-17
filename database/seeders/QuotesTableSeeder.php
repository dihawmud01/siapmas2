<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('quotes')->truncate();

        \DB::table('quotes')->insert([
            [
                'id' => 1,
                'img' => 'waduh.jpeg',
                'name' => 'Soe Hok Gie',
                'who' => 'Aktivis Orde Lama',
                'quote' => 'Hidup adalah keberanian menghadapi tanda tanya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'img' => 'waduh.jpeg',
                'name' => 'Khalil Gibran',
                'who' => 'Seniman, Penyair, Penulis',
                'quote' => 'Apa saja yang membakar dan membuat orang lain terbakar adalah berguna.,
',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
