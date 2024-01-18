<?php

namespace Database\Seeders;

use App\Models\bus\master_bus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            ['name'=>'Bus Besar'],
            ['name'=>'Bus Kecil'],
            ['name'=>'Bus Sedang'],
        ];
        master_bus::insert($data);
    }
}
