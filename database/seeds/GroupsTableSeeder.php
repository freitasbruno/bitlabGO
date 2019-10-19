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
		$id_user = 1;

		$group = new Group;
		$group->id_parent = 0;
		$group->id_user = $id_user;
		$group->name = 'STUDIO';
		$group->save();
		
		$group1 = new Group;
		$group1->id_parent = 0;
		$group1->id_user = $id_user;
		$group1->name = 'STUDY';
		$group1->save();
	
		$group2 = new Group;
		$group2->id_parent = 0;
		$group2->id_user = $id_user;
		$group2->name = 'MANAGE';
		$group2->save();
	
		$group3 = new Group;
		$group3->id_parent = 1;
		$group3->id_user = $id_user;
		$group3->name = 'ARCH';
		$group3->save();
		
		$group4 = new Group;
		$group4->id_parent = 1;
		$group4->id_user = $id_user;
		$group4->name = 'CODE';
		$group4->save();
	
		$group5 = new Group;
		$group5->id_parent = 2;
		$group5->id_user = $id_user;
		$group5->name = 'ISCTE';
		$group5->save();
	
		$id_user = 2;
	
		$group = new Group;
		$group->id_parent = 0;
		$group->id_user = $id_user;
		$group->name = 'WORK';
		$group->save();
		
		$group1 = new Group;
		$group1->id_parent = 0;
		$group1->id_user = $id_user;
		$group1->name = 'PERSONAL';
		$group1->save();
	
		$group2 = new Group;
		$group2->id_parent = 0;
		$group2->id_user = $id_user;
		$group2->name = 'HOUSES';
		$group2->save();
	
		$group3 = new Group;
		$group3->id_parent = 7;
		$group3->id_user = $id_user;
		$group3->name = 'PHYSIO ABC';
		$group3->save();
		
		$group4 = new Group;
		$group4->id_parent = 7;
		$group4->id_user = $id_user;
		$group4->name = 'SWIMR';
		$group4->save();
	
		$group5 = new Group;
		$group5->id_parent = 8;
		$group5->id_user = $id_user;
		$group5->name = 'SHOPPING';
		$group5->save();
    }
}