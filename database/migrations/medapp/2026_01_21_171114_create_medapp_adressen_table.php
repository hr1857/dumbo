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
        Schema::dropIfExists('medapp_adressen');
        Schema::create('medapp_adressen', function (Blueprint $table) {
            //$table->id();
            $table->ulid('id', 36)->primary();
            $table->string('adresse')->default('');
            $table->string('telefon')->default('');
            $table->string('fachgebiet')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medapp_adressen');
    }
};
