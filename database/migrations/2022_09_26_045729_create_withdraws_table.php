<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('withdraws')) {
            Schema::create('withdraws', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->index('user_id');
                $table->string('transaction_id', 60);
                $table->string('transaction_type', 20)->comment('Bank, Other(Skrill, Neteller, Crypto)');
                $table->unsignedBigInteger('bank_account_id')->nullable();
                $table->unsignedBigInteger('other_transaction_id')->nullable();
                $table->string('block_chain', 100)->nullable();
                $table->string('crypto_name', 100)->nullable();
                $table->string('crypto_address', 255)->nullable();
                $table->double('amount')->default(0);
                $table->string('crypto_amount', 100)->default(0);
                $table->double('charge')->nullable();
                $table->unsignedBigInteger('charge_id')->nullable()->comment('references by transaction_settings table');
                $table->index('charge_id');
                $table->enum('approved_status', ['A', 'P', 'D'])->default('P')->comment('A for approved, P for pending, D for Decline');
                $table->string('note', 100)->nullable();
                $table->unsignedBigInteger('approved_by')->nullable();
                $table->index('approved_by');
                $table->timestamp('approved_date')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('cascade');
                $table->foreign('other_transaction_id')->references('id')->on('other_transactions')->onDelete('cascade');
                $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('charge_id')->references('id')->on('transaction_settings')->onDelete('cascade');
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
        Schema::dropIfExists('withdraws');
    }
}
