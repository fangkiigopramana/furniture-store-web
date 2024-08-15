<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class
        ]);

        $buyer = User::create([
            'name' => 'Buyer 1',
            'email' => 'buyer1@gmail.com',
            'password' => Hash::make('buyerpertama'),
        ]);
        $buyer->assignRole('Buyer');
        
        
        $seller = User::create([
            'name' => 'Seller 1',
            'email' => 'seller1@gmail.com',
            'password' => Hash::make('sellerpertama'),
        ]);
        $seller->assignRole('Seller');
    }
}
