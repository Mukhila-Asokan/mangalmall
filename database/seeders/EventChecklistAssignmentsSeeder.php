<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Carbon;

class EventChecklistAssignmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_checklist_assignments')->insert([
            ['id' => 1, 'category_id' => 1, 'occasion_id' => 1, 'status' => 'Active', 'delete_status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'category_id' => 1, 'occasion_id' => 1, 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'category_id' => 1, 'occasion_id' => 13, 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'category_id' => 1, 'occasion_id' => 5, 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'category_id' => 2, 'occasion_id' => 5, 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'category_id' => 1, 'occasion_id' => 6, 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
