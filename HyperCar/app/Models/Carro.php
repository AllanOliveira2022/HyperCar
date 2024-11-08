<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    protected $table = 'CARRO'; // Nome exato da tabela no MySQL

    // Chave primária personalizada
    protected $primaryKey = 'IdCarro';

    // Desabilite os timestamps se não os estiver utilizando
    public $timestamps = false;

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = ['Modelo', 'Tipo', 'Disponibilidade', 'Placa', 'Quilometragem', 'PrecoDiaria'];

    // Relacionamento com o modelo Reserva (um carro pode ter várias reservas)
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'IdCarro', 'IdCarro');
    }

    // Método para verificar se o carro está disponível
    public function estaDisponivel()
    {
        return $this->Disponibilidade == 1;
    }
}
