<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->enum('notification_for', ['order_confirm', 'new_item', 'new_bid', 'payment_card','ending_bid','approve_product'])->nullable()->comment("It's define by notification settings");
            $table->string('from_table_model')->nullable()->comment('Which table this notification came from ');
            $table->string('table_id')->nullable()->comment('ID of Which table this notification came from ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
