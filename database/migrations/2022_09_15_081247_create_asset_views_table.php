<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('asset_views')) {
            Schema::create('asset_views', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('viewed_by')->nullable()->comment('FK:users(id)');
                $table->unsignedBigInteger('asset_id')->nullable()->comment('FK:assets(id)');
                $table->index('viewed_by');
                $table->index('asset_id');
                $table->foreign('viewed_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('asset_views');
    }
}
