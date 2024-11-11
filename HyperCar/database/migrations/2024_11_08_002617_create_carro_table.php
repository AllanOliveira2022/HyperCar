
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->id('IdCarro');
            $table->string('Modelo');
            $table->string('Tipo');
            $table->integer('Disponibilidade');
            $table->string('Placa', 7)->unique();
            $table->integer('Quilometragem');
            $table->integer('AnoFabricacao');
            $table->decimal('PrecoDiaria', 8, 2);
            $table->foreignId('IdUsuario')->constrained('users'); // Relacionamento com a tabela de usuários
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carros');
    }
};
