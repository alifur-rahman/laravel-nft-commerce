<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('affiliates')) {
            Schema::create('affiliates', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('affiliat_id')->comment('user id as affiliat_id, if user refer other user');
                $table->index('affiliat_id');
                $table->unsignedBigInteger('reference_id')->comment('user id as reference_id, if user references by other user');
                $table->index('reference_id');
                $table->string('token')->nullable()->comment('token from asset');
                $table->foreign('affiliat_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('reference_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('affiliates');
    }
}
