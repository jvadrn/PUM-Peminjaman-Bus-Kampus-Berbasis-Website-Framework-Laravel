<?php

namespace Database\Seeders;

use App\Models\user\master_role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            ['name'=>'admin'],
            ['name'=>'user'],
        ];
        master_role::insert($data);
    }
}
