<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Reservation;
use App\Models\Stand;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scommissions', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->string('type');
            $table->string('status')->default('unsold');
            $table->foreignIdFor(Reservation::class);
            $table->foreignIdFor(Stand::class);
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
        Schema::dropIfExists('scommissions');
    }
};
