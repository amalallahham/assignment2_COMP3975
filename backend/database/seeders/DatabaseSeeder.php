<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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
        // Admin user
        User::create([
            'username' => 'a@a.a',
            'password' => Hash::make('P@$$w0rd'),
            'first_name' => 'Admin',           
            'last_name' => 'User',
            'registration_date' => now(),      
            'is_approved' => true,             
            'role' => 'Admin',
        ]);
        
        User::create([
            'username' => 'c@c.c',
            'password' => Hash::make('P@$$w0rd'),
            'first_name' => 'Contributor',     
            'last_name' => 'User',
            'registration_date' => now(),      
            'is_approved' => true,             
            'role' => 'Contributor',
        ]);

        $this->call(ArticleSeeder::class);

        
    }
}
