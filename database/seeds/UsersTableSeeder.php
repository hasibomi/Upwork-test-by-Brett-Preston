<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->truncate();
        \DB::table('abilities')->truncate();
        \DB::table('users')->truncate();

        $admin = \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456')
        ]);

        $userManager = \App\User::create([
            'name' => 'User Manager',
            'email' => 'usermanager@example.com',
            'password' => bcrypt('123456')
        ]);

        $shopManager = \App\User::create([
            'name' => 'Shop Manager',
            'email' => 'shopmanager@example.com',
            'password' => bcrypt('123456')
        ]);

        Bouncer::assign('administrator')->to($admin);
        Bouncer::allow($userManager)->to('user-manager');
        Bouncer::allow($shopManager)->to('shop-manager');
    }
}
