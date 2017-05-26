<?php

use Illuminate\Database\Seeder;

class cities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
            'city' => 'с.Світязь',
            ],
            [
            'city' => 'смт.Шацьк',
            ],
            [
            'city' => 'с.Підманове',
            ],
            [
            'city' => 'с.Омельне',
            ],
            [
            'city' => 'с.Пульмо',
            ],
            [
            'city' => 'с.Згорани',
            ],
            [
            'city' => 'ур.Гряда',
            ],
        ]);
    }
}
