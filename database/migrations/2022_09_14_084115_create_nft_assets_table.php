<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('nft_assets')) {
            Schema::create('nft_assets', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('category_id')->nullable()->comment('ID of NFT asset Category FK:category(id)');
                $table->integer('token')->nullable()->comment("NFT Token");
                $table->integer('sale_type')->default('2')->comment('1= Fidex Price, 2= Timed Auction, 3= Not for Sale, 4 = Open for offer');

                $table->string('name')->nullable()->comment('name of the nft'); 
                $table->string('contract_date')->nullable()->comment('creation date of the smart contract');
                $table->string('url')->nullable()->comment('the nft url');
                $table->string('owner_id')->nullable()->comment('ID of the NFT owner account, FK: accounts(id)'); 
                $table->integer('base_price')->nullable()->comment('NFT base price');
                $table->date('bit_time')->nullable();
                $table->string('blockchain')->nullable()->comment('like as Ethereum');
                $table->string('price_symbol')->nullable()->comment('Payment symbol (usually ETH, depends on the blockchain where the NFT is minted)'); 
                $table->enum('sales_status', ['pending', 'sold', 'process', 'approved']);
                $table->enum('active_status', ['active', 'deactive']);
                $table->foreign('category_id')->references('id')->on('nft_asset_categories');
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
        Schema::dropIfExists('nft_assets');
    }
}
