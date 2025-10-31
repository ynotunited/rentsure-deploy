<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@rentsure.com'],
            [
                'name' => 'RentSure Admin',
                'phone_number' => '+2348012345678',
                'role' => 'admin',
                'state' => 'Lagos',
                'address' => 'Victoria Island, Lagos',
                'password' => Hash::make('admin123'),
                'verified' => true,
                'verification_badge' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create Test Landlord
        User::firstOrCreate(
            ['email' => 'landlord@test.com'],
            [
                'name' => 'Test Landlord',
                'phone_number' => '+2348012345679',
                'role' => 'landlord',
                'state' => 'Lagos',
                'address' => 'Lekki Phase 1, Lagos',
                'password' => Hash::make('password'),
                'verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create Test Agent
        User::firstOrCreate(
            ['email' => 'agent@test.com'],
            [
                'name' => 'Test Agent',
                'phone_number' => '+2348012345680',
                'role' => 'agent',
                'state' => 'Lagos',
                'address' => 'Ikeja, Lagos',
                'password' => Hash::make('password'),
                'verified' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create Test Tenant
        User::firstOrCreate(
            ['email' => 'tenant@test.com'],
            [
                'name' => 'Test Tenant',
                'phone_number' => '+2348012345681',
                'role' => 'tenant',
                'state' => 'Lagos',
                'address' => 'Surulere, Lagos',
                'nin' => '12345678901',
                'password' => Hash::make('password'),
                'verified' => true,
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Test users created successfully!');
        $this->command->info('Admin: admin@rentsure.com / admin123');
        $this->command->info('Landlord: landlord@test.com / password');
        $this->command->info('Agent: agent@test.com / password');
        $this->command->info('Tenant: tenant@test.com / password');
    }
}
