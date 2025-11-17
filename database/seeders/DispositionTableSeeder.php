<?php

namespace Database\Seeders;

use App\Models\Disposition;
use Illuminate\Database\Seeder;

class DispositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('dispositions')->truncate();

        Disposition::factory()
            ->count(15)
            ->create();
    }
}
