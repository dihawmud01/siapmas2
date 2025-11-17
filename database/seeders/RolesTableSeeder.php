<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        \DB::table('roles')->insert([
            [
                'role' => 'Superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'Admin PC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'Admin PAC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
