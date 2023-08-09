<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Stand;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone');
            $table->string('email')->email();
            $table->string('for');
            $table->string('departure_city')->nullable();
            $table->string('destination_city')->nullable();
            $table->date('departure_date')->nullable();
            // $table->date('return_date')->nullable();
            $table->string('pnr')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('passenger_number')->nullable();
            $table->string('company')->nullable();
            $table->string('fidelity_code')->nullable();
            $table->string('status')->default('Créée');
            $table->longText('description')->nullable();
            $table->longText('token')->nullable();
            $table->string('purchase')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('pay_by')->nullable();
            $table->string('transaction_mode')->nullable();
            $table->foreignId('stand_id')->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignId('study_id')->nullable();
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
        Schema::dropIfExists('reservations');
    }
};
