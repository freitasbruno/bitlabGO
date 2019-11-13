<?php

use Illuminate\Database\Seeder;
use App\Models\Account as Account;
use App\Models\Group as Group;

class AccountsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Create the group parent for each user's acoounts
		for ($i = 1; $i < 3; $i++) {
			$groups = factory(Group::class, rand(2, 5))->create([
				'id_parent' => 0,
				'id_user' => $i
			])->each(function ($group) {
                $group->account()->save(factory(Account::class)->create([
					'id_parent' => $group->id,
					'id_user' => $group->id_user				
				]));
			});
		}
	}
}
