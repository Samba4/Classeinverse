<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('notifications')->insert([
            0 => [
                'id' => '6bd79182-0d88-48b7-8e4e-59dbf3371763',
                'type' => 'App\Notifications\LeconRated',
                'auteur' => 'Samba',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => '2',
                'data' => '{"image":"1FjO392hVtZvjzs4dsnXr0DysPLhwzpiPuNslw5b.jpeg","lecon_id":31,"rate":3,"user":3}'
            ],

            1 => [
                'id' => '6c7b833c-4a12-44d5-8fbe-f542e688b865',
                'type' => 'App\Notifications\LeconRated',
                'auteur' => 'Idriss',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => '2',
                'data' => '{"image":"qcBFhdvIZqOXRUNvdEnGLk9oQKQdfKn5z2FdKw3V.png","lecon_id":32,"rate":5,"user":3}'
            ],
        ]);
    }
}
