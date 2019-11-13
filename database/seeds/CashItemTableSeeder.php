<?php

use Illuminate\Database\Seeder;
use App\Models\Group as Group;
use App\Models\Items\CashItem as CashItem;

class CashItemTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$accounts = Group::has('account')->get();
		$groups = Group::doesntHave('account')->get();

		foreach ($groups as $group) {
			$rand = rand(0, 1);
			if ($rand == 1) {
				$smallCashItems = factory(CashItem::class, rand(1, 10))->states('smallExpenses')->create([
					'id_parent' => $group->id,
					'id_user' => $group->id_user,
					'id_account' => $accounts->random()->id
				]);
			}
			$rand = rand(0, 1);
			if ($rand == 1) {
				$cashItems = factory(CashItem::class, rand(0, 2))->create([
					'id_parent' => $group->id,
					'id_user' => $group->id_user,
					'id_account' => $accounts->random()->id
				]);
			}
		}
	}
}
