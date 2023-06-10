<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ## Admin 
            [
                'name'     => 'Admin',
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('11111111'),
                'role'     => 'admin',
                'status'   => 'active',
            ],
            ## Vendor 
            [
                'name'     => 'Faisal Vendor',
                'username' => 'vendor',
                'email'    => 'vendor@gmail.com',
                'password' => Hash::make('11111111'),
                'role'     => 'vendor',
                'status'   => 'active',
            ],
            ## User Or Customer  
            [
                'name'     => 'User',
                'username' => 'user',
                'email'    => 'user@gmail.com',
                'password' => Hash::make('11111111'),
                'role'     => 'user',
                'status'   => 'active',
            ],
        ]);
    }
}