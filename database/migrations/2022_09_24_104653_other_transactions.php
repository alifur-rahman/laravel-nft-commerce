<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OtherTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('other_transactions')) {
            Schema::create('other_transactions', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->string('transaction_type',20)->comment('Neteller, Skrill, Crypto');
                $table->string('crypto_type', 5)->nullable()->comment('BTC, ETH, LTC, USDT');
                $table->string('crypto_instrument', 50)->nullable()->comment('BTC, ETH, LTC, USDT');
                $table->string('crypto_address', 100)->nullable();
                $table->decimal('crypto_amount', 19, 8)->nullable();
                $table->string('account_name', 100)->nullable();
                $table->string('account_email', 100)->nullable();
                
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_transactions');
    }
}
