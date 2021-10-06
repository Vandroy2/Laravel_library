<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'type' => 'super_admin',
            'name' => 'super_admin',
            'surname' => 'super_admin',
            'email' => 'super@admin.com',
            'password' => Hash::make('qwerty'),
            'birthday' => '1972-02-02',
        ]);
    }
}
