<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('receivings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('supplier_id')->nullable()->default(NULL);
			$table->integer('employee_id');
			$table->string('payment_type', 15)->nullable()->default(NULL);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('receivings');
	}

}
