<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{

    public function run(): void
    {
        // User::factory()->count(1000)->create();
        DB::table('users') ->insert([
            'name'=>'newbie Laravel',
            'email'=>'hoa@gmail.com',
            'password'=> Hash::make('123'),
           ]);
    }
}
