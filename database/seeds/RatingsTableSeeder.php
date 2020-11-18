<?php

use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('lecon_user')->insert([
            1 => [
                'lecon_id' => 1,
                'user_id' => 3,
                'rating' => 1,
            ],
            2 => [
                'lecon_id' => 2,
                'user_id' => 3,
                'rating' => 2,
            ],
            3 => [
                'lecon_id' => 3,
                'user_id' => 3,
                'rating' => 2,
            ],
            4 => [
                'lecon_id' => 4,
                'user_id' => 3,
                'rating' => 2,
            ],
            5 => [
                'lecon_id' => 5,
                'user_id' => 2,
                'rating' => 5,
            ],
            6 => [
                'lecon_id' => 6,
                'user_id' => 2,
                'rating' => 5,
            ],
            7 => [
                'lecon_id' => 7,
                'user_id' => 2,
                'rating' => 3,
            ],
            8 => [
                'lecon_id' => 8,
                'user_id' => 2,
                'rating' => 2,
            ],
            9 => [
                'lecon_id' => 9,
                'user_id' => 3,
                'rating' => 3,
            ],
            10 => [
                'lecon_id' => 10,
                'user_id' => 3,
                'rating' => 3,
            ]
        ]);
    }
}
