<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftAssetImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('nft_asset_images')) {
            Schema::create('nft_asset_images', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('nft_asset_id')->comment('FK:nft_asset(id)');
                $table->string('image');
                $table->timestamps();
                $table->foreign('nft_asset_id')->references('id')->on('nft_assets');
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
        Schema::dropIfExists('nft_asset_images');
    }
}
