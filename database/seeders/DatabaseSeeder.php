<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Domain\Models\Candidate;
use Domain\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
     
        User::factory()->count(10)->create();
        Candidate::factory()->count(10)->create();
        $this->call(RoleSeeder::class);
        DB::table('users')->insert([
            'name' => 'JHON BERNAL',
            'username' => 'jbernal',
            'role' =>  1,
            'is_Active' => 1,
            'password' => bcrypt('123456'), // password
            'remember_token' => Str::random(10),
            'last_login' =>  \Carbon\Carbon::now()->format('d-m-Y H:i:s')
        ]);
    }
}
