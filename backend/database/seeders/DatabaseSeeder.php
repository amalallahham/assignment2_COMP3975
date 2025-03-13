<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            [
                'username' => 'a@a.a',
                'password' => Hash::make('P@$$w0rd'),
                'firstName' => 'Admin',
                'lastName' => 'User',
                'registrationDate' => Carbon::now(),
                'isApproved' => true,
                'role' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username' => 'c@c.c',
                'password' => Hash::make('P@$$w0rd'),
                'firstName' => 'Contributor',
                'lastName' => 'User',
                'registrationDate' => Carbon::now(),
                'isApproved' => true,
                'role' => 'Contributor',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
