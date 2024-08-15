<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
    }
}
