<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SeederPlant extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plant_tag')->delete();
        DB::table('plant')->delete();
        DB::table('plant')->insert($this->getData());
        DB::table('plant_tag')->insert($this->getDataTag());
        DB::table('action')->delete();
        DB::table('action')->insert($this->getDataActions());
        DB::table('users')->delete();
        DB::table('users')->insert($this->getDataUsers());
    }

    private function getDataActions(): array
    {
        $data = [];
        $data[] = ["id" => 1, "name" => "Полив", "info" => 'Полив осуществляется лейкой с водой'];
        $data[] = ["id" => 2, "name" => "Удобрение", "info" => 'Удобрение при помощие специальных средств'];
        $data[] = ["id" => 3, "name" => "Обработка", "info" => 'Обработка от вредителей и насекомых'];
        return $data;
    }

    private function getData(): array
    {
        $faker = Factory::create('ru_RU');

        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $imgNum = ($i % 10) + 1;
            $data[] = [
                'id' => $i + 1,
                'name' => $faker->word(),
                'add_date' => $faker->dateTimeBetween('2021-01-01'),
                'short_info' => $faker->realText(mt_rand(10, 25)),
                'full_info' => $faker->realText(mt_rand(150, 200)),
                'photo_small_path' => "image{$imgNum}.jpg",
                'photo_big_path' => "image{$imgNum}.jpg",
                'watering_days' => mt_rand(1, 10),
                'manuring_days' => mt_rand(1, 15),
                'pest_control_days' => mt_rand(1, 30),
            ];
        }
        return $data;
    }

    private function getDataTag(): array
    {
        $tags1 = ["напольные", "настольные", "подвесные"];
        $tags2 = ["теневыносливые", "светолюбивые"];
        $tags3 = ["не цветущие", "цветущие"];
        $tags4 = ["выделяют кислород", "очищают воздух"];
        $selects = DB::table('plant')->select("id")->get();

        $data = [];
        foreach ($selects as $select) {
            $tag1 = $tags1[mt_rand(0, count($tags1) - 1)];
            $tag2 = $tags2[mt_rand(0, count($tags2) - 1)];
            $tag3 = $tags3[mt_rand(0, count($tags3) - 1)];
            $tag4 = $tags4[mt_rand(0, count($tags4) - 1)];
            $data[] = [
                "plant_id" => $select->id,
                "tag" => $tag1
            ];
            $data[] = [
                "plant_id" => $select->id,
                "tag" => $tag2
            ];
            $data[] = [
                "plant_id" => $select->id,
                "tag" => $tag3
            ];
            $data[] = [
                "plant_id" => $select->id,
                "tag" => $tag4
            ];
        }
        return $data;
    }

    private function getDataUsers()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'admin',
                'role' => 'admin',
                'email' => 'admin@admin.ru',
                'password' => Hash::make('adminadmin'),
                'telegram_user_id' =>513318812
            ],
            [
                'id' => 2,
                'name' => 'user',
                'role' => 'user',
                'email' => 'user@user.ru',
                'password' =>  Hash::make('useruser'),
                'telegram_user_id' =>522575015
            ]
        ];
        return $data;
    }
}
