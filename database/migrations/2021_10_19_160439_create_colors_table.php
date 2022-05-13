<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('primaryColor',20)->nullable()->comment('Primary color');
            $table->string('subheading',20)->nullable()->comment('Subheading color');
            $table->string('bggrdleft',20)->nullable()->comment('Background left color');
            $table->string('bggrdright',20)->nullable()->comment('Background right color');
            $table->string('btngrdleft',20)->nullable()->comment('Button gradient left color');
            $table->string('bggrdleft2',20)->nullable()->comment('Button gradient 2 left color');
            $table->string('copyrights',20)->nullable()->comment('Copyrights Background color');
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
        Schema::dropIfExists('colors');
    }
}
