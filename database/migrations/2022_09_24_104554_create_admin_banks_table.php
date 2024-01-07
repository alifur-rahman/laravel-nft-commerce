<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('admin_banks')) {
            Schema::create('admin_banks', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->string('tab_selection', 55);
                $table->string('tab_name', 100);
                $table->string('bank_name', 255);
                $table->string('account_name', 100);
                $table->string('account_number', 255);
                $table->string('swift_code', 255);
                $table->string('ifsc_code', 255);
                $table->string('routing', 255);
                $table->string('bank_country', 255);
                $table->string('bank_address', 255);
                $table->integer('minimum_deposit');
                $table->string('note', 255);
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
        Schema::dropIfExists('admin_banks');
    }
}
