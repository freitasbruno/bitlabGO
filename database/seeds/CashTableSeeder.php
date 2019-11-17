<?php

use Illuminate\Database\Seeder;
use App\Models\Group as Group;
use App\Models\Item as Item;
use App\Models\Items\Cash as Cash;

class CashTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$accounts = Group::has('account')->get();
		$items = Item::all();

		foreach ($items as $item) {
			$rand = rand(0, 1);
			if ($rand == 1) {
				$cash = factory(Cash::class, 1)->states('smallExpenses')->create([
					'id_parent' => $item->id,
					'id_user' => $item->id_user,
					'id_account' => $accounts->random()->id
				]);
			} else {
				$rand = rand(0, 1);
				if ($rand == 1) {
					$cash = factory(Cash::class, 1)->create([
						'id_parent' => $item->id,
						'id_user' => $item->id_user,
						'id_account' => $accounts->random()->id
					]);
				}
			}
		}
	}
}
