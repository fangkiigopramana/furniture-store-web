<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Buyer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Seller',
                'guard_name' => 'web',
            ],
        ];

        DB::table('roles')->insert($datas);

        $system  = User::create([
            'name' => 'System',
            'email' => 'system@gmail.com',
            'password' => Hash::make('password_system_123'),
        ]);
        $system->assignRole('Seller');
    }
}
