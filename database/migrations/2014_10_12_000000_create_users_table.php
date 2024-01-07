<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('phone')->unique()->nullable();
                $table->tinyInteger('type')->nullable()->comment('0 for user, 1 for staff, 2 for admin');

                $table->string('password');
                $table->string('transaction_password')->nullable();
                $table->boolean("active_status")->default(1)->comment('1 for active status, 0 for disabled status');
                $table->boolean("login_status")->default(0)->comment('1 for true, 0 for false');
                $table->timestamp('email_verified_at')->nullable();
                $table->boolean('g_auth')->default(0)->comment('Google 2 step 1 for inable, 0 for disable');
                $table->boolean('email_auth')->default(0)->comment('Email auth 1 for inable, 0 for disable');
                $table->string('secret_key', 64)->nullable();
                $table->boolean('email_verification')->default(0)->comment('0 for false, 1 for true');
                $table->boolean('withdraw_operation')->default(0)->comment('0 for false, 1 for true');

                $table->boolean('tmp_pass')->default(0)->comment('0 for false, 1 for true');
                $table->boolean('tmp_tran_pass')->default(0)->comment('0 for false, 1 for true');

                $table->rememberToken();
                $table->foreignId('current_team_id')->nullable();
                $table->string('profile_photo', 2048)->nullable();
                $table->string('cover_photo', 2048)->nullable();
                $table->timestamps();
    
                $table->string('facebook_id')->nullable(); 
                $table->string('google_id')->nullable(); 

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
        Schema::dropIfExists('users');
    }
};
