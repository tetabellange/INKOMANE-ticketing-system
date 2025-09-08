<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
      
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@inkomane.com',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

       
        User::create([
            'name' => 'Support Agent',
            'email' => 'agent@inkomane.com',
            'password' => Hash::make('password123'),
            'role' => 'agent'
        ]);

       
        User::create([
            'name' => 'John Customer',
            'email' => 'customer@inkomane.com',
            'password' => Hash::make('password123'),
            'role' => 'customer'
        ]);

        echo "Created test users:\n";
        echo "Admin: admin@inkomane.com / password123\n";
        echo "Agent: agent@inkomane.com / password123\n";
        echo "Customer: customer@inkomane.com / password123\n";
    }
}