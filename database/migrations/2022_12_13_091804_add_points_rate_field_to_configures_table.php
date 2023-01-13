<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPointsRateFieldToConfiguresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configures', function (Blueprint $table) {
            $table->float('points_rate_per_kilo')->default(10);
            $table->integer('marketer_joining_fee')->default(0);
            $table->integer('golden_marketer_joining_fee')->default(0);
            $table->integer('marketer_joining_points')->default(100);
            $table->integer('marketer_invitation_number_each_join')->default(10);
            $table->boolean('auto_generate_invitation_code')->default(false);
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
