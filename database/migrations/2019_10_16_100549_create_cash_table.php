<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('id_parent')->default(0);
			$table->integer('id_account')->default(0);
			$table->integer('id_user');
			$table->enum('type', ['expense', 'income']);
			$table->float('amount', 20, 2);
			$table->enum('currency', ['EUR', 'USD']);
			$table->boolean('recurring')->default(false);
			$table->integer('interval')->nullable();
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
        Schema::dropIfExists('cash');
    }
}
