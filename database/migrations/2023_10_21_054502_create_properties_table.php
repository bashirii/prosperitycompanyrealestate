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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by');
            $table->integer('property_id');
            $table->string('description');
            $table->string('img');
            $table->string('youtube_link');
            $table->string('address');
            $table->string('location');
            $table->integer('area');
            $table->integer('beds');
            $table->integer('baths');
            $table->integer('garages');
            $table->integer('price');
            $table->unsignedBigInteger('agent_id');
            $table->timestamps();

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('agent_id')
                ->references('id')
                ->on('teams')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
