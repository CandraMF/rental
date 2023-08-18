<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kendaraan;
use App\Models\Member;
use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use function PHPSTORM_META\map;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        $role_admin = Role::create(['name' => 'admin']);
        $role_petugas = Role::create(['name' => 'petugas']);
        $role_member = Role::create(['name' => 'member']);

        $admin = Petugas::create([
            'nama' => 'Petugas Administrasi',
            'no_telp' => '08111111111',
            'ttl' => '2021-01-01',
            'alamat' => 'alamat petugas administrasi'
        ]);

        $petugas = Petugas::create([
            'nama' => 'Petugas Penyewaan',
            'no_telp' => '08111111111',
            'ttl' => '2021-01-01',
            'alamat' => 'alamat petugas penyewaan'
        ]);

        $member  = Member::create([
            'nama' => 'Member 1',
            'no_ktp' => '321321213123123',
            'no_sim' => '23213123123',
            'no_telp' => '082111231231',
            'ttl' => '2021-01-01',
            'alamat' => 'alamat member',
        ]);

        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'user_id' => $admin->id,
        ]);

        $petugas = \App\Models\User::factory()->create([
            'name' => 'Petugas',
            'email' => 'petugas@example.com',
            'user_id' => $petugas->id,
        ]);

        $member = \App\Models\User::factory()->create([
            'name' => 'Member',
            'email' => 'member@example.com',
            'user_id' => $member->id
        ]);

        $kendaraan = Kendaraan::create([
            'plat_nomor' => 'B 123 X',
            'no_stnk' => '123123123',
            'nama_kendaraan' => 'Tesla Model X',
            'harga_sewa' => 500000,
            'status' => 1,
        ]);

        $admin->assignRole('admin');
        $petugas->assignRole('petugas');
        $member->assignRole('member');
    }
}
