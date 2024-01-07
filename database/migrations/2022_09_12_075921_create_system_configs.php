<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemConfigs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('system_configs')) {
            Schema::create('system_configs', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                // theme setup
                $table->json('theme')->nullable();
                $table->json('logo')->nullable()->comment('multiple logos here, like as brand logo, brand logo for email');
                $table->json('fab_icon')->nullable()->comment('multiple fabicon here, like as apple fabicon, android fabicon, desktop fabicon');

                // privacy statement
                $table->text('privacy_statement')->nullable();

                // software settings
                
                $table->tinyInteger('brute_force_attack')->default(0)->comment('1 for activate, 0 for deactivate');
                $table->boolean('social_account')->default(1)->comment('1 for social account take from user, 0 for not take');

                // kyc back part required
                $table->boolean('kyc_back_part')->default(0)->comment('0=>only front, 1=>front and back part are required');
                $table->tinyInteger('notification_tour')->default(0)->comment('check admin info for notification');
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
        Schema::dropIfExists('system_configs');
    }
}
 