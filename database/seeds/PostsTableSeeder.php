<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 4; $i++) { 
        	DB::table('posts')->insert([
        		'user_id' => 1,
	            'text' => $faker->text(),
	            'created_at' => time(),
	            'updated_at' => time()
	        ]);
        }
    }
}
