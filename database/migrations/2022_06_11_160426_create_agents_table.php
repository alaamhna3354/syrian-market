<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('whatsapp');
            $table->string('email');
            $table->string('company_name');
            $table->string('company_address');
            $table->string('country');
            $table->string('region');
            $table->decimal('expected_purchasing_power', 11, 2)->default(0);
            $table->string('note');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('agents');
    }
}
