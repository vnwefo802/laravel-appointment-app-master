<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServicesIdToPiercingAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('piercing_appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('services_id')->unsigned();
            $table->foreign('services_id')
                  ->references('id')
                  ->on('piercing_services')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('piercing_appointments', function (Blueprint $table) {
            //
        });
    }
}
