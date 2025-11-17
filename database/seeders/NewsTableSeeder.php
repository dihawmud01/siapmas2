<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('news')->delete();

        \DB::table('news')->insert([
            [
                'title' =>
                    'Lama Tak Terdengar, PC IPNU IPPNU Banyumas PAC Baturraden Kembali Melaksanakan Diskusi Senja Di Tempat Tak Terduga',
                'slug' =>
                    'lama-tak-terdengar-pc-ipnu-ippnu-banyumas-pac-baturraden-kembali-melaksanakan-diskusi-senja-di-tempat-tak-terduga',
                'content' =>
                    '<p><strong>PC IPNU IPPNU Banyumas PAC Baturraden </strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at elementum nibh. Nunc vel risus felis. Integer sit amet ex id leo imperdiet porta. Maecenas neque nulla, aliquet ut tincidunt non, sodales in enim. Nam aliquet convallis arcu, sed vehicula elit blandit vel. Mauris commodo eu ipsum ac fermentum. In in lorem eleifend, ornare orci non, imperdiet ligula. Sed non dictum massa. Ut ac nibh eleifend, posuere arcu nec, posuere nibh. In consequat nisi in dolor efficitur, sit amet tristique ante pharetra. Quisque laoreet odio et maximus molestie. Vestibulum tempus, sapien et ullamcorper feugiat, ex dolor pretium justo, porttitor dapibus tellus ex et lorem. Maecenas suscipit lectus eu pellentesque accumsan. Donec non est rhoncus, congue lacus vitae, ornare nibh. Vestibulum vitae fringilla dolor, sit amet convallis nunc.</p>',
                'img' => 'waduh.jpeg',
                'category_id' => 1,
                'user_id' => 1,
                'views' => 0,
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' =>
                    'Lama Tak Terdengar, PC IPNU IPPNU Banyumas PAC Baturraden Kembali Melaksanakan Diskusi Senja Di Tempat Tak Terduga',
                'slug' => 'lorem-ipsum',
                'content' =>
                    '<p><strong>PC IPNU IPPNU Banyumas PAC Baturraden </strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at elementum nibh. Nunc vel risus felis. Integer sit amet ex id leo imperdiet porta. Maecenas neque nulla, aliquet ut tincidunt non, sodales in enim. Nam aliquet convallis arcu, sed vehicula elit blandit vel. Mauris commodo eu ipsum ac fermentum. In in lorem eleifend, ornare orci non, imperdiet ligula. Sed non dictum massa. Ut ac nibh eleifend, posuere arcu nec, posuere nibh. In consequat nisi in dolor efficitur, sit amet tristique ante pharetra. Quisque laoreet odio et maximus molestie. Vestibulum tempus, sapien et ullamcorper feugiat, ex dolor pretium justo, porttitor dapibus tellus ex et lorem. Maecenas suscipit lectus eu pellentesque accumsan. Donec non est rhoncus, congue lacus vitae, ornare nibh. Vestibulum vitae fringilla dolor, sit amet convallis nunc.</p>',
                'img' => 'waduh.jpeg',
                'category_id' => 1,
                'user_id' => 1,
                'views' => 0,
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' =>
                    'Lama Tak Terdengar, PC IPNU IPPNU Banyumas PAC Baturraden Kembali Melaksanakan Diskusi Senja Di Tempat Tak Terduga',
                'slug' => 'lorem-ipsum-2',
                'content' =>
                    '<p><strong>PC IPNU IPPNU Banyumas PAC Baturraden </strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at elementum nibh. Nunc vel risus felis. Integer sit amet ex id leo imperdiet porta. Maecenas neque nulla, aliquet ut tincidunt non, sodales in enim. Nam aliquet convallis arcu, sed vehicula elit blandit vel. Mauris commodo eu ipsum ac fermentum. In in lorem eleifend, ornare orci non, imperdiet ligula. Sed non dictum massa. Ut ac nibh eleifend, posuere arcu nec, posuere nibh. In consequat nisi in dolor efficitur, sit amet tristique ante pharetra. Quisque laoreet odio et maximus molestie. Vestibulum tempus, sapien et ullamcorper feugiat, ex dolor pretium justo, porttitor dapibus tellus ex et lorem. Maecenas suscipit lectus eu pellentesque accumsan. Donec non est rhoncus, congue lacus vitae, ornare nibh. Vestibulum vitae fringilla dolor, sit amet convallis nunc.</p>',
                'img' => 'waduh.jpeg',
                'category_id' => 1,
                'user_id' => 1,
                'views' => 0,
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lorem Ipsum',
                'slug' => 'lorem-ipsum-3',
                'content' =>
                    '<p><strong>Lorem Ipsum </strong>dolor sit amet, consectetur adipiscing elit. Nulla at elementum nibh. Nunc vel risus felis. Integer sit amet ex id leo imperdiet porta. Maecenas neque nulla, aliquet ut tincidunt non, sodales in enim. Nam aliquet convallis arcu, sed vehicula elit blandit vel. Mauris commodo eu ipsum ac fermentum. In in lorem eleifend, ornare orci non, imperdiet ligula. Sed non dictum massa. Ut ac nibh eleifend, posuere arcu nec, posuere nibh. In consequat nisi in dolor efficitur, sit amet tristique ante pharetra. Quisque laoreet odio et maximus molestie. Vestibulum tempus, sapien et ullamcorper feugiat, ex dolor pretium justo, porttitor dapibus tellus ex et lorem. Maecenas suscipit lectus eu pellentesque accumsan. Donec non est rhoncus, congue lacus vitae, ornare nibh. Vestibulum vitae fringilla dolor, sit amet convallis nunc.</p>',
                'img' => 'news_-1739296490.png',
                'category_id' => 2,
                'user_id' => 2,
                'views' => 0,
                'active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
