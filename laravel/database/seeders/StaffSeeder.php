<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sampleStaff = [
            [
                'name' => 'Alice Smith',
                'email' => 'alice.smith@example.com',
                'phone' => '123-456-7890',
                'role' => 'Practice Owner',
                'status' => 'Active',
                'is_archived' => false,
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob.johnson@example.com',
                'phone' => '234-567-8901',
                'role' => 'Director',
                'status' => 'Inactive',
                'is_archived' => false,
            ],
            [
                'name' => 'Carol Lee',
                'email' => 'carol.lee@example.com',
                'phone' => null,
                'role' => 'Front Office Admin',
                'status' => 'Active',
                'is_archived' => false,
            ],
            [
                'name' => 'David Kim',
                'email' => 'david.kim@example.com',
                'phone' => '345-678-9012',
                'role' => 'Records Custodian',
                'status' => 'Inactive',
                'is_archived' => true,
            ],
            [
                'name' => 'Eve Turner',
                'email' => 'eve.turner@example.com',
                'phone' => '456-789-0123',
                'role' => 'Director',
                'status' => 'Active',
                'is_archived' => false,
            ],
        ];

        foreach ($sampleStaff as $staff) {
            Staff::create($staff);
        }
    }
}
