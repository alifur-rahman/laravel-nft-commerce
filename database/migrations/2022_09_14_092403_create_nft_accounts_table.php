<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftAccountsTable extends Migration
{
    /**
     *  Run the migrations.
     *  The accounts table includes the accounts that have participated in at least one transaction from
     *  the nft_sales table. One row represents one unique account on the OpenSea platform.
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('nft_accounts')) {
            Schema::create('nft_accounts', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable()->comment('FK:users(id)');
                $table->index('user_id');
                $table->string('user_name')->nullable()->comment('nft user name');
                $table->string('address')->nullable()->comment('Account address unique');
                $table->string('private_key')->nullable()->comment('Private key for gnerate seccret key(address)');
                $table->json('details')->nullable()->comment('Other extra data fields (JSONB)');
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
        Schema::dropIfExists('nft_accounts');
    }
}
