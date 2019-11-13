<?php

use Illuminate\Database\Seeder;
use App\Models\Group as Group;
use App\Models\User as User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this->call([			
			UsersTableSeeder::class,
			GroupsTableSeeder::class,
			AccountsTableSeeder::class,
			CashItemTableSeeder::class,
		]);
    }
}
