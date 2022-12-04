<?php

use App\Models\TattooBodyPart;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTattooAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tattoo_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TattooBodyPart::class)->nullable()->constrained();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->datetime('start_time');
            $table->decimal('deposit', 15, 2)->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('tattoo_appointments');
    }
}
