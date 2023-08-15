<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // $role_admin = Role::create(['name' => 'admin']);
        // $role_petugas = Role::create(['name' => 'petugas']);
        // $role_member = Role::create(['name' => 'member']);

        // $admin = \App\Models\User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@example.com',
        // ]);

        // $petugas = \App\Models\User::factory()->create([
        //     'name' => 'Petugas',
        //     'email' => 'petugas@example.com',
        // ]);

        // $member = \App\Models\User::factory()->create([
        //     'name' => 'Member',
        //     'email' => 'member@example.com',
        // ]);

        // $admin->assignRole('admin');
        // $petugas->assignRole('petugas');
        // $member->assignRole('member');

    }
}
