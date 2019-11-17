<?php

use Illuminate\Database\Seeder;
use App\Models\Group as Group;
use App\Models\Item as Item;

class ItemTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$groups = Group::doesntHave('account')->get();

		foreach ($groups as $group) {
			$rand = rand(0, 1);
			if ($rand == 1) {
				$items = factory(Item::class, rand(1, 10))->create([
					'id_parent' => $group->id,
					'id_user' => $group->id_user
				]);
			}
		}
	}
}
