<?php

use Illuminate\Database\Seeder;
use App\Models\Group as Group;


class GroupsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		//$groups = factory(Group::class, 20)->states('homeGroup')->create();

		$group = new Group;
		$group->id_parent = 0;
		$group->id_user = 1;
		$group->name = 'HOME';
		$group->save();

		$group = new Group;
		$group->id_parent = 0;
		$group->id_user = 2;
		$group->name = 'HOME';
		$group->save();

		// for ($i = 1; $i < 3; $i++) {
		// 	$groups = factory(Group::class, rand(1, 7))->create([
		// 		'id_parent' => $i,
		// 		'id_user' => $i
		// 	]);

		// 	foreach ($groups as $group) {
		// 		$rand = rand(0, 1);
		// 		if ($rand == 1) {
		// 			$childGroups = factory(Group::class, rand(1, 7))->create([
		// 				'id_parent' => $group->id,
		// 				'id_user' => $group->id_user
		// 			]);

		// 			foreach ($childGroups as $childGroup) {
		// 				$rand = rand(0, 1);
		// 				if ($rand == 1) {
		// 					factory(Group::class, rand(1, 7))->create([
		// 						'id_parent' => $childGroup->id,
		// 						'id_user' => $childGroup->id_user
		// 					]);
		// 				}
		// 			}
		// 		}
		// 	}
		// }

	}
}
