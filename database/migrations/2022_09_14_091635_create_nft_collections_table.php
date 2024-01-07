<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *The collections table holds information about the NFT collections.
     *One row represents a unique NFT collection. One collection includes
     *multiple unique NFTs (that are in the assets table).
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('nft_collections')) {
            Schema::create('nft_collections', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('user_id')->comment('FK:users(id)');
                $table->index('user_id');
                $table->json('slug')->nullable()->comment('Slug of the collections unique');
                $table->string('name')->nullable()->comment('Name of the collection');
                $table->string('url')->nullable()->comment('Url of the collection');
                $table->string('profile_photo')->nullable()->comment('Profile Photo of collection');
                $table->string('cover_photo')->nullable()->comment('cover Photo of collection');
                $table->string('details',200)->nullable()->comment('Other extra data ');
                $table->json('item')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('nft_collections');
    }
}
