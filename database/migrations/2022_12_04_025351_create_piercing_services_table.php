<?php

use App\Models\ServicesPiercing;
use App\Models\PiercingBodyPart;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiercingServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piercing_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PiercingBodyPart::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ServicesPiercing::class)->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('piercing_services');
    }
}
