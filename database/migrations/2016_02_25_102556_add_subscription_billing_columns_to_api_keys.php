<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscriptionBillingColumnsToApiKeys extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('api_keys', function(Blueprint $table)
		{
			$table->tinyInteger('billing_active')->default(0);
			$table->string('billing_subscription')->nullable();
			$table->tinyInteger('billing_free')->default(0);
			$table->string('billing_plan', 25)->nullable();
			$table->integer('billing_amount')->default(0);
			$table->string('billing_interval')->nullable();
			$table->integer('billing_quantity')->default(0);
			$table->string('billing_card')->nullable();
			$table->timestamp('billing_trial_ends_at')->nullable();
			$table->timestamp('billing_subscription_ends_at')->nullable();
			$table->text('billing_subscription_discounts')->nullable();
			
			$table->index('billing_subscription', 'billing_subscription_index');
			$table->index('billing_card', 'billing_card_index');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('api_keys', function(Blueprint $table)
		{
			$table->dropIndex('billing_subscription_index');
			$table->dropIndex('billing_card_index');
			
			$table->dropColumn(
				'billing_active', 'billing_subscription', 'billing_free', 'billing_plan', 'billing_amount',
				'billing_interval', 'billing_quantity', 'billing_card', 'billing_trial_ends_at',
				'billing_subscription_ends_at', 'billing_subscription_discounts'
			);
		});
	}
}
