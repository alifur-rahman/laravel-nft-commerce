<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('bank_accounts')) {
            Schema::create('bank_accounts', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('bank_name', 255);
                $table->string('bank_ac_name', 100);
                $table->string('bank_ac_number', 100);
                $table->string('bank_swift_code', 50);
                $table->string('bank_iban', 50);
                $table->string('bank_address', 255);
                $table->string('bank_country', 50);
                $table->binary('note')->nullable();
                $table->string('approve_status', 50)->default('p')->comment('p->panding, a->approved, d->declined');
                $table->boolean('status')->default('0')->comment('0->deactive, 1->active');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('bank_accounts');
    }
}
