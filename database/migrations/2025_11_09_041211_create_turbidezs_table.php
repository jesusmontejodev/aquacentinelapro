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
        Schema::create('turbidezs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_boya')
                    ->constrained('boyas')
                    ->onDelete('cascade');

            $table->decimal( 'nivel_turbidez', 15, 10);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turbidezs');
    }
};
