<?php

use App\Models\PiercingBodyPart;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiercingAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piercing_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PiercingBodyPart::class)->nullable()->constrained();
            $table->datetime('start_time');
            $table->decimal('price', 15, 2)->nullable();
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
        Schema::dropIfExists('piercing_appointments');
    }
}
