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
        Schema::create('boyas', function (Blueprint $table) {
            $table->id();

            // Llave foránea al usuario
            $table->unsignedBigInteger(column: 'id_user');
            $table->text('codigo_de_canjeo');

            $table->foreign('id_user')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade'); // si el usuario se borra, borra las boyas asociadas

            $table->string('nombre');
            $table->decimal('latitud', 15, 10);
            $table->decimal('longitud', 15, 10);
            $table->string('modelo');
            $table->date('fecha_fabricacion');
            $table->date('fecha_mantenimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boyas');
    }
};
