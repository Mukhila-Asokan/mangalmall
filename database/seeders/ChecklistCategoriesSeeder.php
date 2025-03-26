<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ChecklistCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('checklistcategories')->insert([
            ['id' => 1, 'name' => 'Pre-Event Planning', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Day of Event Execution', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Post Event follow up', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Engagement', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Pre wedding shoot', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Sangeet', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Pre wedding Mehndi party', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Day Before & Wedding Day', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'name' => 'Post-Wedding Arrangements', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'name' => 'Planning 4 weeks before', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'name' => 'Activities', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'name' => 'Pre-Baptism Preparation', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'name' => 'Baptism Day Essentials', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'name' => 'After the Baptism', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'name' => 'Pre-Ceremony Preparations', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'name' => 'Sacrificial Animal Arrangement', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'name' => 'Baby’s Religious Traditions', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'name' => 'Event Setup & Hospitality', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 19, 'name' => 'Post-Ceremony Duties', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'name' => 'fddfsf', 'status' => 'Active', 'delete_status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
