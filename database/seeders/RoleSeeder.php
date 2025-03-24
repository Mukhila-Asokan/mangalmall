<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\StaffManagement\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::truncate();

        $data = [
            [
                'rolename' => 'Super Admin',
                'departmentid' => 1,
                'status' => 'Active',
                'delete_status' => 0
            ],
            [
                'rolename' => 'Technical Engineer',
                'departmentid' => 4,
                'status' => 'Active',
                'delete_status' => 0
            ],
            [
                'rolename' => 'Office Administrators',
                'departmentid' => 3,
                'status' => 'Active',
                'delete_status' => 0
            ],
            [
                'rolename' => 'Digital Marketing',
                'departmentid' => 5,
                'status' => 'Active',
                'delete_status' => 0
            ],
            [
                'rolename' => 'Visual Designers',
                'departmentid' => 6,
                'status' => 'Active',
                'delete_status' => 0
            ]
        ];
        
        Roles::insert($data);
    }
}
