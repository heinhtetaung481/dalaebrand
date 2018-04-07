<?php

use Illuminate\Database\Seeder;

class ItemtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //DB::table('itemtypes')->delete();

        App\Itemtype::create([

        	['name' => 'shoe',
        	'type' => 'slipper',
        	'gender' => 'Male',],

        	['name' => 'shoe',
        	'type' => 'slipper',
        	'gender' => 'Female',],

        	['name' => 'shoe',
        	'type' => 'ponedaw',
        	'gender' => 'Female',]

    ]);
    }
}
