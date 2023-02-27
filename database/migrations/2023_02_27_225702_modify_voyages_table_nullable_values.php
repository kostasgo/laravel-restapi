<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('voyages', function (Blueprint $table) {
            $table->decimal('revenues', 8, 2)->nullable()->change();
            $table->decimal('expenses', 8, 2)->nullable()->change();
            $table->decimal('profit', 8, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('voyages', function (Blueprint $table) {
            $table->decimal('revenues', 8, 2)->nullable(false)->change();
            $table->decimal('expenses', 8, 2)->nullable(false)->change();
            $table->decimal('profit', 8, 2)->nullable(false)->change();
        });
    }
};
