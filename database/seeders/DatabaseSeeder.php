<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \DB::table('roles')->insert([
//            ['role' => 1],
//            ['role' => 2],
//            ['role' => 3],
//        ]);

        \DB::table('users')->insert([
           [
               'username' => 'admin_warehouse',
               'name' => 'Admin System',
               'phone_number' => '0999999999',
               'email' => 'admin@gmail.com',
               'password' => '$2y$10$DXdXd3jQA0V07LRF2YkEEuf3YECqLgXOK.MkYavY1IgGp9G3fIiwu',
               'is_active' => config('common.active'),
               'role_id' => config('common.role.admin'),
           ]
        ]);
    }
}
