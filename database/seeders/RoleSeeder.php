<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrator with full access',
            ],
            [
                'name' => 'writer',
                'description' => 'Content writer who can create and manage posts',
            ],
            [
                'name' => 'reader',
                'description' => 'Reader who can comment and like posts',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
