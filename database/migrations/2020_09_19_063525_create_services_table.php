<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_title')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('link')->nullable();
            $table->string('username')->nullable();
            $table->bigInteger('min_amount')->nullable();
            $table->bigInteger('max_amount')->nullable();
            $table->string('price')->nullable();
            $table->tinyInteger('service_status')->nullable();
            $table->string('service_type')->nullable();
            $table->bigInteger('api_provider_id')->nullable();
            $table->bigInteger('api_service_id')->nullable();
            $table->string('api_provider_price')->nullable();
            $table->tinyInteger('drip_feed')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('services');
    }
}
