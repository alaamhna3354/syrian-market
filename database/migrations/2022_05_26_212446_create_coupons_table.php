<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('sale');
            $table->integer('number_of_beneficiaries')->nullable();
            $table->integer('number_of_use')->nullable();
            $table->boolean('is_percent')->default(0);
            $table->boolean('status')->default(0);
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
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
        Schema::dropIfExists('coupons');
    }
}
