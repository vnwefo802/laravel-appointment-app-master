<?php

use App\Models\PiercingServices;
use App\Models\PiercingBodyparts;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiercingBodypartServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piercing_bodypart_services', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(PiercingBodyparts::class)->constrained()->cascadeOnDelete();
            // $table->foreignIdFor(PiercingServices::class)->constrained()->cascadeOnDelete();

            // $table->unsignedBigInteger('piercingservices_id')->unsigned();
            // $table->foreign('piercingservices_id')
            //           ->references('id')
            //           ->on('piercingservices')
            //           ->onDelete('cascade')
            //           ->onUpdate('cascade');


            $table->unsignedBigInteger('piercingbodypart_id')->unsigned();
            $table->foreign('piercingbodypart_id')
                      ->references('id')
                      ->on('piercing_bodyparts')
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
        Schema::dropIfExists('piercing_bodypart_services');
    }
}
