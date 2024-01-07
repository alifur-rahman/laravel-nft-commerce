<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('smtp')) {
            Schema::create('smtp', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                // smtp setup
                $table->string('mail_driver', 32)->nullable()->comment('smtp mail driver for email configuration');
                $table->string('host', 64)->nullable()->comment('smtp host name');
                $table->string('port', 64)->nullable()->comment('smtp port');
                $table->string('mail_user', 100)->nullable()->comment('smtp configuration user name');
                $table->string('mail_password', 100)->nullable()->comment('smtp configuration password');
                $table->string('mail_encryption', 100)->nullable()->comment('smtp encryption type like tls, ssl');
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
        Schema::dropIfExists('smtp');
    }
}
