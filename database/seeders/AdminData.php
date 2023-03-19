<?php

namespace Database\Seeders;

use App\Interfaces\Admin as AdminInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminData extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     *
     * @return void
     */

     private AdminInterface $admin;

     public function __construct(AdminInterface $admin)
     {
        $this->admin = $admin;
     }
    public function run()
    {
        $this->admin->insert([
            'name' => 'Admin',
            'email' => 'admin@packt.com',
            'password' => Hash::make('Admin@123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
