<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bids')) {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->index('asset_id');
            $table->unsignedBigInteger('bidder_id')->nullable();
            $table->index('bidder_id');
            $table->double('offer_price')->default(0);
            $table->tinyInteger('status')->nullable()->comment('0 for deactive, 1 for active');
            $table->foreign('asset_id')->references('id')->on('nft_assets')->onDelete('cascade');
            $table->foreign('bidder_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('bids');
    }
}
