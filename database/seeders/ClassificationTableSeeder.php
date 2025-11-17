<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('classifications')->delete();

        \DB::table('classifications')->insert([
            'code' => 'ADM',
            'type' => 'Administrasi',
            'description' => 'Jenis surat yang berkaitan dengan administrasi',
        ]);
    }
}
