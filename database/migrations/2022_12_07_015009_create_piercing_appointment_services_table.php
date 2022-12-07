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
            $table->foreignIdFor(PiercingAppointment::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PiercingServices::class)->constrained()->cascadeOnDelete();
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
