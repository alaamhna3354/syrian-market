<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarketerConfigsToConfiguresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configures', function (Blueprint $table) {
            $table->integer('marketer_joining_points')->default(500);
            $table->integer('marketer_invitation_number_each_join')->default(10);
            $table->boolean('auto_generate_invitation_code')->default(false);
            $table->boolean('golden_refund')->default(true);
            $table->boolean('marketers_swap')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configures', function (Blueprint $table) {
            //
        });
    }
}
