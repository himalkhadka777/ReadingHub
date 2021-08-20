<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

		DB::table('orders')->insert([
			'name'=>"John Doe",
			'phone'=>9876543210,
			'address'=>"Nepal",
			'product_name'=>'Product',
			'quantity'=>57,   
			'price'=>2599, 
			'status'=>'not delivered',  
		]);
    }
} 
