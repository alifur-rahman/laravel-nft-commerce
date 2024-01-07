<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSecurityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_security')) {
            Schema::create('user_security', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->index('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->boolean('withdraw_otp')->default(1)->comment('need otp when withdraw request 0 or 1');
                $table->boolean('password_otp')->default(1)->comment('need otp when change password request 0 or 1');
                $table->boolean('transaction_pin_otp')->default(1)->comment('need otp when change transaction pin request 0 or 1');
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
        Schema::dropIfExists('user_security');
    }
}
