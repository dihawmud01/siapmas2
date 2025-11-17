<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('letter_statuses')->delete();

        \DB::table('letter_statuses')->insert([
            [
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'Belum disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
