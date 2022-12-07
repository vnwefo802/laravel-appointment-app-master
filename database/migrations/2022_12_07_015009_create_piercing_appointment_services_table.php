<?php

use App\Models\PiercingAppointment;
use App\Models\PiercingServices;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiercingAppointmentServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piercing_appointment_services', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('appointment_id')->unsigned();
            $table->foreign('appointment_id')
                  ->references('id')
                  ->on('appointments')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

                  $table->unsignedBigInteger('pier_appoint_servic')->unsigned();
                  $table->foreign('pier_appoint_servic')
                        ->references('id')
                        ->on('piercing_appointments')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
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
        Schema::dropIfExists('piercing_appointment_services');
    }
}
