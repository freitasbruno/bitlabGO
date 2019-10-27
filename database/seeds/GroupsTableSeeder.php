<?php

use App\Models\Account;
use Illuminate\Database\Seeder;
use App\Models\Group as Group;
use App\Models\Items\ItemCash as ItemCash;


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

		
		for ($i=1; $i < 3; $i++) { 
			$groups = factory(Group::class, rand(1, 7))->create([
				'id_parent' => $i,
				'id_user' => $i
			]);		
			
			foreach($groups as $group) {
				$rand_1 = rand(0, 1);
				if ($rand_1 == 1){
					$childGroups = factory(Group::class, rand(1, 7))->create([
						'id_parent' => $group->id,
						'id_user' => $group->id_user
					]);

					foreach($childGroups as $childGroup) {
						$rand_2 = rand(0, 1);
						if ($rand_2 == 1){
							$smallCashItems = factory(ItemCash::class, rand(1, 10))->states('smallExpenses')->create([
								'id_parent' => $childGroup->id,
								'id_user' => $childGroup->id_user,
								'id_account' => Account::where('id_user', $childGroup->id_user)->get()->random()->id
							]);
							$cashItems = factory(ItemCash::class, rand(0, 2))->create([
								'id_parent' => $childGroup->id,
								'id_user' => $childGroup->id_user,
								'id_account' => Account::where('id_user', $childGroup->id_user)->get()->random()->id
							]);	
						}
					}		
				}				
				
				$rand_3 = rand(0, 1);
				if ($rand_3 == 1){
					$smallCashItems = factory(ItemCash::class, rand(1, 10))->states('smallExpenses')->create([
						'id_parent' => $group->id,
						'id_user' => $group->id_user,
						'id_account' => Account::where('id_user', $group->id_user)->get()->random()->id
					]);
					$cashItems = factory(ItemCash::class, rand(0, 2))->create([
						'id_parent' => $group->id,
						'id_user' => $group->id_user,
						'id_account' => Account::where('id_user', $group->id_user)->get()->random()->id
					]);	
				}	
			}
		}

		//$groups = factory(Group::class, 250)->create();
				
		/*
		$id_user = 1;

		$group = new Group;
		$group->id_parent = 1;
		$group->id_user = $id_user;
		$group->name = 'STUDIO';
		$group->save();
		
		$group1 = new Group;
		$group1->id_parent = 1;
		$group1->id_user = $id_user;
		$group1->name = 'STUDY';
		$group1->save();
	
		$group2 = new Group;
		$group2->id_parent = 1;
		$group2->id_user = $id_user;
		$group2->name = 'MANAGE';
		$group2->save();
	
		$group3 = new Group;
		$group3->id_parent = 3;
		$group3->id_user = $id_user;
		$group3->name = 'ARCH';
		$group3->save();
		
		$group4 = new Group;
		$group4->id_parent = 3;
		$group4->id_user = $id_user;
		$group4->name = 'CODE';
		$group4->save();
	
		$group5 = new Group;
		$group5->id_parent = 4;
		$group5->id_user = $id_user;
		$group5->name = 'ISCTE';
		$group5->save();
	
		$id_user = 2;
	
		$group = new Group;
		$group->id_parent = 2;
		$group->id_user = $id_user;
		$group->name = 'WORK';
		$group->save();
		
		$group1 = new Group;
		$group1->id_parent = 2;
		$group1->id_user = $id_user;
		$group1->name = 'PERSONAL';
		$group1->save();
	
		$group2 = new Group;
		$group2->id_parent = 2;
		$group2->id_user = $id_user;
		$group2->name = 'HOUSES';
		$group2->save();
	
		$group3 = new Group;
		$group3->id_parent = 2;
		$group3->id_user = $id_user;
		$group3->name = 'PHYSIO ABC';
		$group3->save();
		
		$group4 = new Group;
		$group4->id_parent = 2;
		$group4->id_user = $id_user;
		$group4->name = 'SWIMR';
		$group4->save();
	
		$group5 = new Group;
		$group5->id_parent = 2;
		$group5->id_user = $id_user;
		$group5->name = 'SHOPPING';
		$group5->save();
		*/
    }
}