<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('deposits')) {
            Schema::create('deposits', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('invoice_id', 50);
                $table->string('account', 50)->nullable();
                $table->string('transaction_type', 25)->nullable();
                $table->string('transaction_id')->nullable();
                $table->string('incode')->nullable();
                $table->string('block_chain')->nullable();
                $table->string('crypto_name')->nullable();
                $table->string('crypto_address')->nullable();
                $table->double('amount');
                $table->string('crypto_amount', 100)->default(0);
                $table->double('charge');
                $table->unsignedBigInteger('approved_by')->nullable();
                $table->index('approved_by');
                $table->string('order_id', 64)->nullable()->comment('order_id from api');
                $table->string('bank_proof')->nullable()->comment('like as document');
                $table->string('bank_id')->nullable()->comment('admin bank id');
                $table->string('ip_address')->nullable()->comment('user ip address');
                $table->enum('approved_status', ['A', 'P', 'D'])->default('P')->comment('A for approved, P for pending, D for Decline');
                $table->string('note')->nullable();
                $table->timestamp('approved_date')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('deposits');
    }
}
