<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_cash', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('id_parent')->default(0);
			$table->integer('id_user');
            $table->string('name', 300);
			$table->longText('description')->nullable();
			$table->enum('type', ['expense', 'income']);
			$table->float('amount', 8, 2);
			$table->enum('currency', ['EUR', 'USD']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_cash');
    }
}
