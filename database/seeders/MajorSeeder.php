<?php

namespace Database\Seeders;

use App\Models\user\master_major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            ['name'=>'Ekonomi Dan Bisnis'],
            ['name'=>'Peternakan'],
            ['name'=>'Budidaya Tanaman Perkebunan'],
            ['name'=>'Budidaya Tanaman Pagan'],
            ['name'=>'Teknologi Pertanian'],
        ];
        master_major::insert($data);
    }
}
