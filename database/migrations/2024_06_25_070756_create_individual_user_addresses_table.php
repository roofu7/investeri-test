<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('individual_user_addresses', function (Blueprint $table) {
            $table->id();

            $table->string('region');
            $table->string('city');
            $table->string('street');
            $table->string('house_number');
            $table->string('building_number');
            $table->string('room_number');
            $table->foreignId('individual_user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individual_user_addresses');
    }
};
