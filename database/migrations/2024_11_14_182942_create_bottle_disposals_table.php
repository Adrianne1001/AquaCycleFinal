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
        Schema::create('bottle_disposals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('points_received');
            $table->integer('bottles_qty');
            $table->integer('small_qty');
            $table->integer('med_qty');
            $table->integer('large_qty');
            $table->integer('xl_qty');
            $table->integer('xxl_qty');
            $table->dateTime('disposal_date');
            $table->string('trashbag_fill_status');
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
        Schema::dropIfExists('bottle_disposals');
    }
};
