<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('company_infos')) {
            Schema::create('company_infos', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                // company setup
                $table->string('com_name', 60)->nullable();
                $table->string('com_logo')->nullable();
                $table->string('com_license', 60)->nullable();
                $table->json('com_email')->nullable();
                $table->json('com_phone')->nullable();
                $table->string('com_website', 60)->nullable();
                $table->string('com_authority', 60)->nullable();
                $table->string('com_address', 255)->nullable();
                $table->string('copyright', 60)->nullable();
                $table->string('support_email', 60)->nullable();
                $table->string('auto_email', 60)->nullable();
                $table->json('com_social_info')->nullable();
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
        Schema::dropIfExists('company_infos');
    }
}
