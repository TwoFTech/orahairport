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
        Schema::create('stand_user', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('default')->default(false);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Stand::class);
            $table->string('token')->nullable();
            $table->string('role');
           
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
        Schema::dropIfExists('stand_user');
    }
};
