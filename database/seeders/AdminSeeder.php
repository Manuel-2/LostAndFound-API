<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::findOrCreate('admin', 'web');

        $manu = User::create([
            'name' => 'Manuel',
            'phone' => "6122880833",
            'email' => "mape_23@alu.uabcs.mx",
            'password' => Hash::make(Str::random(20)),
        ]);
        $manu->assignRole($adminRole);

        $cris = User::create([
            'name' => 'Cristian',
            'email' => "cburgoin_23@alu.uabcs.mx",
            'password' => Hash::make(Str::random(20)),
        ]);
        $cris->assignRole($adminRole);


        $emi = User::create([
            'name' => 'Emiliano',
            'email' => "emilianof_23@alu.uabcs.mx",
            'password' => Hash::make(Str::random(20)),
        ]);
        $emi->assignRole($adminRole);


        $batiz = User::create([
            'name' => 'Batiz',
            'email' => "marcosdanb_23@alu.uabcs.mx",
            'password' => Hash::make(Str::random(20)),
        ]);
        $batiz->assignRole($adminRole);
    }
}
