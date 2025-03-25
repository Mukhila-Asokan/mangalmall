<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\StaffManagement\Models\Departments;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departments::truncate();

        $data = [
            [
                'departmentname' => 'Super Admin',
                'status' => 'Active',
                'delete_status' => 0
            ],
            [
                'departmentname' => 'Product Team',
                'status' => 'Active',
                'delete_status' => 0
            ],
            [
                'departmentname' => 'HR and Admin Team',
                'status' => 'Active',
                'delete_status' => 0
            ],
            [
                'departmentname' => 'Customer Support Team',
                'status' => 'Active',
                'delete_status' => 0
            ],
            [
                'departmentname' => 'Marketing Team',
                'status' => 'Active',
                'delete_status' => 0
            ],
            [
                'departmentname' => 'Design Team',
                'status' => 'Active',
                'delete_status' => 0
            ]
        ];

        Departments::insert($data);
    }
}
