<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_providers', function (Blueprint $table) {
            $table->id();
            $table->string('api_name')->nullable();
            $table->string('url')->nullable();
            $table->string('api_key')->nullable();
            $table->string('balance')->nullable();
            $table->string('currency')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('api_providers');
    }
}
