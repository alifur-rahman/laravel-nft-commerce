<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftAssetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('nft_asset_details')) {
            Schema::create('nft_asset_details', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('nft_asset_id')->comment('FK:nft_assets(id)');
                $table->json('levels')->nullable()->comment("data field name and value, Levels show up underneath your item, are clickable, and can be filtered in your collection's sidebar.");
                $table->json('properties')->nullable()->comment(" data fields type and name (JSONB), like as type and name. Properties show up underneath your item, are clickable, and can be filtered in your collection's sidebar.");
                $table->json('states')->nullable()->comment(" data fields name and value (JSONB), like as type and name. Stats show up underneath your item, are clickable, and can be filtered in your collection's sidebar.");
                
                $table->string('description')->nullable()->comment('description of the nft');
                $table->string('slug')->nullable(); 
                $table->json('meta_tags')->nullable(); 

                $table->json('unblockable_content')->nullable()->comment('content (access key, code to redeem, link to a file, etc.)');
                $table->boolean('sensitive_content')->nullable()->comment('Set this item as explicit and sensitive content');
                $table->integer('supply')->nullable()->comment('The number of items that can be minted. No gas cost to user');
 
                $table->foreign('nft_asset_id')->references('id')->on('nft_assets')->onDelete('cascade');  
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
        Schema::dropIfExists('nft_asset_details');
    }
}
