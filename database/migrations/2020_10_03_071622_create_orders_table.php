<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('service_id')->nullable();
            $table->bigInteger('api_order_id')->nullable();
            $table->string('link')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->double('price','10','2')->nullable();
            $table->string('status')->nullable();
            $table->string('status_description')->nullable();
            $table->text('reason')->nullable();
            $table->tinyInteger('agree')->nullable();
            $table->bigInteger('start_counter')->nullable();
            $table->bigInteger('remains')->nullable();
            $table->tinyInteger('runs')->nullable();
            $table->tinyInteger('interval')->nullable();
            $table->tinyInteger('drip_feed')->nullable();
            $table->timestamp('added_on', 0);
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
        Schema::dropIfExists('orders');
    }
}
