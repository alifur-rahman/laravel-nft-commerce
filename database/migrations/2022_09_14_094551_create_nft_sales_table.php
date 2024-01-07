<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftSalesTable extends Migration
{
    /**
     * Run the migrations.
     *The nft_sales table contains information about successful sale transactions
     *in time-series form. One row represents one successful sale event on the OpenSea platform.
     *id field is a unique field provided by the OpenSea API.
     *total_price field is the price paid for the NFTs in ETH (or other cryptocurrency payment symbol available on OpenSea).
     *quantity field indicates how many NFTs were sold in the transaction (can be more than 1).
     *auction_type field is NULL by default, unless the transaction happened as part of an auction.
     *asset_id and collection_id fields can be used to JOIN the supporting relational tables.
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('nft_sales')) {
            Schema::create('nft_sales', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->timestamp('time')->nullable()->comment('time of the sale');
                $table->unsignedBigInteger('asset_id')->nullable()->comment('ID of the NFT, FK: assets(id)');
                $table->index('asset_id');
                $table->unsignedBigInteger('collection_id')->nullable()->comment('ID of the collection this NFT belongs to, FK: collections(id))');
                $table->index('collection_id');
                $table->string('auction_type')->nullable()->comment("Auction type ('dutch', 'english', 'min_price')");
                $table->string('contract_address')->nullable()->comment("Address of the smart contract");
                $table->integer('quantity')->nullable()->comment("NFT quantity sold");
                $table->string('payment_symbol')->nullable()->comment("Payment symbol (usually ETH, depends on the blockchain where the NFT is minted)");
                $table->float('total_price')->nullable()->comment('Total price paid for the NFT');
                $table->unsignedBigInteger('seller_account')->nullable()->comment("Seller's account, FK: accounts(id)");
                $table->unsignedBigInteger('from_account')->nullable()->comment("Account used to transfer from, FK: accounts(id)");
                $table->unsignedBigInteger('to_account')->nullable()->comment('Account used to transfer to, FK: accounts(id)');
                $table->unsignedBigInteger('winner_account')->nullable()->comment("Buyer's account, FK: accounts(id)");
                $table->enum('order_status', ['pending', 'process', 'done', 'cancel']);
                 $table->string('note', 191)->nullable();
                $table->unsignedBigInteger('order_id')->nullable();
                $table->index('order_id');
                // $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('nft_sales');
    }
}
