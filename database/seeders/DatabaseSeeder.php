<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'is_admin'   => true,
            'email'      => 'samochreno@gmail.com',
            'password'   => Hash::make('admin'),
            'first_name' => 'Samuel',
            'last_name'  => 'Chreno',
        ]);

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
