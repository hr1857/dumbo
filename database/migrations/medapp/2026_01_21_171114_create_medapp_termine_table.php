<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('medapp_termine');
        Schema::create('medapp_termine', function (Blueprint $table) {
            //$table->id();
            $table->ulid('id', 36)->primary();
            $table->date('eintragsdatum')->default('1970-01-01');
            $table->timestamp('termindatum')->useCurrent(); //('1970-01-01 00:00:01');
            $table->string('termintext')->default('');
            $table->string('terminadresse')->default('');
            $table->integer('fahrstrecke_km')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medapp_termine');
    }
};
