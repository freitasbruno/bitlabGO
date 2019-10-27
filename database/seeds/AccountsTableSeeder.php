<?php

use Illuminate\Database\Seeder;
use App\Models\Account as Account;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {		
		$accounts_1 = factory(Account::class, rand(2, 5))->create([
			'id_parent' => 0,
			'id_user' => 1
		]);	
		
		$accounts_2 = factory(Account::class, rand(2, 5))->create([
			'id_parent' => 0,
			'id_user' => 2
		]);	
    }
}