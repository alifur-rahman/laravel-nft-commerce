<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_invoices', function (Blueprint $table) { 
            $table->id();
            $table->integer('invoice_number')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->index('order_id');
            $table->foreign('order_id')->references('id')->on('orders'); 
            $table->string('saller_id')->nullable()->comment('ID of the NFT saller account');
            $table->string('buyer_id')->nullable()->comment('ID of the NFT buyer account');
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('order_invoices');
    }
}
