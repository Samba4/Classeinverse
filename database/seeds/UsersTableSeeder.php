<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        User::create([
            'lastname' => 'Coulibaly',
            'name' => 'Samba',
            'email' => 'samba9674@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('samba'),
            'settings' => '{"pagination": 8}',
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'lastname' => 'Demdoum',
            'name' => 'Ichem',
            'email' => 'ichem@chezlui.fr',
            'password' => bcrypt('user'),
            'settings' => '{"pagination": 8}',
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'lastname' => 'Mezaber',
            'name' => 'Yanis',
            'email' => 'yanis@chezlui.fr',
            'password' => bcrypt('user'),
            'settings' => '{"pagination": 8}',
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'lastname' => 'Dumillier',
            'name' => 'Guillaume',
            'email' => 'guillaume@chezlui.fr',
            'password' => bcrypt('user'),
            'settings' => '{"pagination": 8}',
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'lastname' => 'Bouzidi',
            'name' => 'Idriss',
            'email' => 'idriss@chezlui.fr',
            'password' => bcrypt('user'),
            'settings' => '{"pagination": 8}',
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'lastname' => 'Soyiffi',
            'name' => 'Rahime',
            'email' => 'rahime@chezlui.fr',
            'password' => bcrypt('user'),
            'settings' => '{"pagination": 8}',
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'lastname' => 'Tounekti',
            'name' => 'Jessim',
            'email' => 'jessim@chezlui.fr',
            'password' => bcrypt('user'),
            'settings' => '{"pagination": 8}',
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
