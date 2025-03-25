<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class invitationdigitalcard_size extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('invitationdigitalcard_size')->insert([
            [
                'size_name' => '1200x885',
                'size_width' => '1200px',
                'size_height' => '885px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_name' => '1200x1200',
                'size_width' => '1200px',
                'size_height' => '1200px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_name' => '940x940',
                'size_width' => '940px',
                'size_height' => '940px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_name' => '735x1102',
                'size_width' => '735px',
                'size_height' => '1102px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'size_name' => '1024x512',
                'size_width' => '1024px',
                'size_height' => '512px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'size_name' => '497x373',
                'size_width' => '497px',
                'size_height' => '373px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'size_name' => '851x315',
                'size_width' => '851px',
                'size_height' => '315px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'size_name' => '1500x500',
                'size_width' => '1500px',
                'size_height' => '500px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'size_name' => '1200x628',
                'size_width' => '1200px',
                'size_height' => '628px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'size_name' => '250x250',
                'size_width' => '250px',
                'size_height' => '250px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'size_name' => '1920x1080',
                'size_width' => '1920px',
                'size_height' => '1080px',
                'Status' => 'Active',
                'delete_status' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
