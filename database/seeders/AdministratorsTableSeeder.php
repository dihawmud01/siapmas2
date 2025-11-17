<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdministratorsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('administrators')->truncate();

        \DB::table('administrators')->insert([
            [
                'img' => 'waduh.jpeg',
                'name' => 'Riki Ramdan',
                'username' => 'rikiramdan',
                'position' => 'Ketua PC IPNU IPPNU Banyumas',
                'fb' => null,
                'ig' => null,
                'x' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'img' => 'waduh.jpeg',
                'name' => 'Riki Ramdan',
                'username' => 'rikiramdan',
                'position' => 'Ketua PC IPNU IPPNU Banyumas',
                'fb' => null,
                'ig' => null,
                'x' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'img' => 'waduh.jpeg',
                'name' => 'Riki Ramdan',
                'username' => 'rikiramdan',
                'position' => 'Ketua PC IPNU IPPNU Banyumas',
                'fb' => null,
                'ig' => null,
                'x' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
