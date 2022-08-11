<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        $data [] = [
            'name'=>'Админ',
            'email'=>'admin@testmailg.ru',
            'password'=>bcrypt('qwerty1234'),
        ];


        DB::table('users')->insert($data);
    }
}
