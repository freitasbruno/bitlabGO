<?php

use Illuminate\Database\Seeder;

class ItemCashTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_cash')->insert([
			'id_user' => 1,
			'id_parent' => 1,
            'name' => 'Coffee and cake',
            'type' => 'expense',
			'amount' => 5.60,
			'currency' => 'EUR',
			'created_at' => date("Y-m-d H:i:s")
		]);

		DB::table('item_cash')->insert([
			'id_user' => 1,
			'id_parent' => 1,
            'name' => 'May salary',
            'type' => 'income',
			'amount' => 1800,
			'currency' => 'EUR',
			'created_at' => date("Y-m-d H:i:s")
		]);
    }
}
