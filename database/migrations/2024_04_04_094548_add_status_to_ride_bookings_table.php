<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToRideBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('ride_bookings', function (Blueprint $table) {
            $table->string('status')->default('In afwachting');
        });
    }

    public function down()
    {
        Schema::table('ride_bookings', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}