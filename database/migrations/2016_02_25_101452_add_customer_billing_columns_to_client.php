<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerBillingColumnsToClient extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('client', function(Blueprint $table)
		{
			$table->string('billing_id')->nullable();
			$table->text('billing_cards')->nullable();
			$table->text('billing_discounts')->nullable();
			
			$table->index('billing_id', 'billing_id_index');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('client', function(Blueprint $table)
		{
			$table->dropIndex('billing_id_index');
			
			$table->dropColumn('billing_id', 'billing_cards', 'billing_discounts');
		});
	}
}
