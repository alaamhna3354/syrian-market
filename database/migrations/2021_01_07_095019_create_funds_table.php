<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('gateway_id')->nullable();
            $table->string('gateway_currency')->nullable();
            $table->decimal('amount',18,8)->default(0);
            $table->decimal('charge',18,8)->default(0);
            $table->decimal('rate',18,8)->default(0);
            $table->decimal('final_amount',18,8)->default(0);
            $table->decimal('btc_amount',18,8)->nullable();
            $table->string('btc_wallet')->nullable();
            $table->string('transaction',25)->nullable();
            $table->integer('try')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('funds');
    }
}
