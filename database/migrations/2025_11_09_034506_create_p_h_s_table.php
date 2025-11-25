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
        Schema::create('p_h_s', function (Blueprint $table) {
            $table->id();

            // ✅ forma moderna, crea la columna + la llave foránea en una sola línea
            $table->foreignId('id_boya')
                    ->constrained('boyas')
                    ->onDelete('cascade');

            // ✅ decimal es perfecto para medidas exactas
            $table->decimal('nivel_ph', 15, 10);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_h_s');
    }
};
