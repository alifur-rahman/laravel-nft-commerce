<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('favorites')) {
            Schema::create('favorites', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('favorite_by')->nullable()->comment('FK:users(id)');
                $table->index('favorite_by');
                $table->unsignedBigInteger('asset_id')->nullable()->comment('FK:assets(id)');
                $table->index('asset_id');
                $table->foreign('favorite_by')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('asset_id')->references('id')->on('nft_assets')->onDelete('cascade');
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
        Schema::dropIfExists('favorites');
    }
}
