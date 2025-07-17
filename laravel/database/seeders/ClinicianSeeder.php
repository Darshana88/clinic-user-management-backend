<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clinician;

class ClinicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create supervising clinicians first
        $supervisor1 = Clinician::create([
            'name' => 'Dr. Alice Supervisor',
            'email' => 'alice.supervisor@example.com',
            'phone' => '111-222-3333',
            'role' => 'Psychotherapist',
            'location' => 'CA',
            'languages' => ['English', 'Spanish'],
            'supervising_clinician_id' => null,
            'status' => 'Active',
            'is_archived' => false,
        ]);

        $supervisor2 = Clinician::create([
            'name' => 'Dr. Bob Mentor',
            'email' => 'bob.mentor@example.com',
            'phone' => '222-333-4444',
            'role' => 'Case Manager',
            'location' => 'NY',
            'languages' => ['English'],
            'supervising_clinician_id' => null,
            'status' => 'Active',
            'is_archived' => false,
        ]);

        // Create clinicians with supervisors
        Clinician::create([
            'name' => 'Carol Navigator',
            'email' => 'carol.navigator@example.com',
            'phone' => '333-444-5555',
            'role' => 'Navigator',
            'location' => 'TX',
            'languages' => ['English', 'Portuguese'],
            'supervising_clinician_id' => $supervisor1->id,
            'status' => 'Active',
            'is_archived' => false,
        ]);

        Clinician::create([
            'name' => 'David Case',
            'email' => 'david.case@example.com',
            'phone' => null,
            'role' => 'Case Manager',
            'location' => 'FL',
            'languages' => ['Spanish'],
            'supervising_clinician_id' => $supervisor2->id,
            'status' => 'Inactive',
            'is_archived' => false,
        ]);

        Clinician::create([
            'name' => 'Eva Psychotherapist',
            'email' => 'eva.psy@example.com',
            'phone' => '444-555-6666',
            'role' => 'Psychotherapist',
            'location' => 'WA',
            'languages' => ['English', 'Spanish', 'Portuguese'],
            'supervising_clinician_id' => $supervisor1->id,
            'status' => 'Active',
            'is_archived' => true,
        ]);
    }
}
