<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker\Factory::create();
        //
		for ($i = 1; $i < 100; $i++)
		{
			\App\Employee::create(['lastname' => str_random(10),
						  'firstname' => str_random(10),
						  'middlename' => str_random(10),
						  'birthday' => $faker->dateTimeBetween('-80 years', '-55 years'),
						  'deathday' => $faker->dateTimeBetween('-5 years', '-1 years'),
						  'address' => $faker->address]);

		}
	}
}