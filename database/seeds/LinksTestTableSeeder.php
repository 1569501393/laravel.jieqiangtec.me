<?php

use Illuminate\Database\Seeder;

class LinksTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'link_name' => '后盾网',
                'link_title' => '人人做后盾',
                'link_url' => 'www.houdunwang.com',
                'link_order' => 0,
                // 'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),


            ],
            [
                'link_name' => str_random(10),
                'link_title' => str_random(10) . '@gmail.com',
                'link_url' => 'www.houdunwang.com',
                'link_order' => 0,
                'updated_at' => '2019-04-27 10:35:04',

            ]
        ];

        DB::table('links_test')->insert($data);
    }
}
