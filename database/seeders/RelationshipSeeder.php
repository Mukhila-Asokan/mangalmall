<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Relationship;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['label' => 'Father', 'value' => 'Father'],
            ['label' => 'Mother', 'value' => 'Mother'],
            ['label' => 'Son', 'value' => 'Son'],
            ['label' => 'Daughter', 'value' => 'Daughter'],
            ['label' => 'Brother', 'value' => 'Brother'],
            ['label' => 'Sister', 'value' => 'Sister'],
            ['label' => 'Grandfather', 'value' => 'Grandfather'],
            ['label' => 'Grandmother', 'value' => 'Grandmother'],
            ['label' => 'Grandson', 'value' => 'Grandson'],
            ['label' => 'Granddaughter', 'value' => 'Granddaughter'],
            ['label' => 'Uncle', 'value' => 'Uncle'],
            ['label' => 'Aunt', 'value' => 'Aunt'],
            ['label' => 'Nephew', 'value' => 'Nephew'],
            ['label' => 'Niece', 'value' => 'Niece'],
            ['label' => 'Cousin', 'value' => 'Cousin'],
            ['label' => 'Father-in-law', 'value' => 'Father-in-law'],
            ['label' => 'Mother-in-law', 'value' => 'Mother-in-law'],
            ['label' => 'Brother-in-law', 'value' => 'Brother-in-law'],
            ['label' => 'Sister-in-law', 'value' => 'Sister-in-law'],
            ['label' => 'Best Friend', 'value' => 'Best Friend'],
            ['label' => 'Close Friend', 'value' => 'Close Friend'],
            ['label' => 'Acquaintance', 'value' => 'Acquaintance'],
            ['label' => 'Colleague', 'value' => 'Colleague'],
            ['label' => 'Mentor', 'value' => 'Mentor'],
            ['label' => 'Mentee', 'value' => 'Mentee'],
            ['label' => 'Neighbor', 'value' => 'Neighbor'],
            ['label' => 'Boss', 'value' => 'Boss'],
            ['label' => 'Employee', 'value' => 'Employee'],
            ['label' => 'Co-worker', 'value' => 'Co-worker'],
            ['label' => 'Client', 'value' => 'Client'],
            ['label' => 'Teacher', 'value' => 'Teacher'],
            ['label' => 'Student', 'value' => 'Student'],
            ['label' => 'Coach', 'value' => 'Coach'],
            ['label' => 'Trainee', 'value' => 'Trainee']
        ];

        Relationship::insert($data);
    }
}
