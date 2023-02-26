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
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->integer('vessel_id');
            $table->string('code');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('status');
            $table->decimal('revenues', 8, 2);
            $table->decimal('expenses', 8, 2);
            $table->decimal('profit', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
