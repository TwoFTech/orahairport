<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\Cabin;
use App\Models\Reservation;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone')->nullable();
            $table->string('sex')->nullable();
            $table->string('email')->nullable();
            $table->date('birthdate')->nullable();
            // $table->string('departure_city')->nullable();
            // $table->string('destination_city')->nullable();
            // $table->date('departure_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('formula')->nullable();
            $table->string('amount')->nullable();
            // $table->string('company')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_file')->nullable();
            $table->string('ticket_number')->nullable();
            $table->string('ticket_file')->nullable();
            $table->string('category')->nullable();
            $table->string('cabin')->nullable();
            $table->foreignIdFor(Reservation::class);
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
        Schema::dropIfExists('passengers');
    }
};
