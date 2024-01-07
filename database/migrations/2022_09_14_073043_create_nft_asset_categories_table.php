<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftAssetCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     

        if (!Schema::hasTable('nft_asset_categories')) {
            Schema::create('nft_asset_categories', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id(); 
                $table->string('category')->nullable();
                $table->text('description')->nullable()->comment('Category Description for NFT assets');
                $table->string('slug')->nullable()->comment('slug for url and seo');
                $table->json('meta_tags')->nullable()->comment('Category Tags for meta'); 
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
        Schema::dropIfExists('nft_asset_categories');
    }
}
