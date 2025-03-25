<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoryChecklistItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_checklist_items')->insert([
            ['id' => 1, 'category_id' => 1, 'item_name' => 'Plan event schedule and agenda', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'category_id' => 1, 'item_name' => 'Fix the Event Calendar, Choose the Venue, and Set a Budget', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'category_id' => 1, 'item_name' => 'Invite key speakers, panel experts, and session hosts', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'category_id' => 1, 'item_name' => 'Arrange catering, accommodations, and transportation (if applicable)', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'category_id' => 2, 'item_name' => 'Test microphones, projectors, screens, and lighting', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'category_id' => 2, 'item_name' => 'Check internet connectivity and backup solutions', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'category_id' => 2, 'item_name' => 'Prepare presentation slides and speaker materials', 'status' => 'Active', 'delete_status' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'category_id' => 1, 'item_name' => 'jjjjj', 'status' => 'Active', 'delete_status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
