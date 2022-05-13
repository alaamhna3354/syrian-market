<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_controls', function (Blueprint $table) {
            $table->id();
            $table->string('actionMethod')->nullable();
            $table->string('actionUrl')->nullable();
            $table->text('headerData')->nullable();
            $table->text('paramData')->nullable();
            $table->text('formData')->nullable();
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
        Schema::dropIfExists('sms_controls');
    }
}
