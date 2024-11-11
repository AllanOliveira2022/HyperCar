<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'RESERVA'; // Nome exato da tabela no MySQL

    // Chave primária personalizada
    protected $primaryKey = 'IdReserva';

    // Desabilite os timestamps se não os estiver utilizando
    public $timestamps = false;

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = ['IdUsuario', 'IdCarro', 'DataInicio', 'DataFim', 'Estatus', 'DataDevolucao','ValorTotal'];

    // Relacionamento com o modelo Usuario (uma reserva pertence a um único usuário)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'IdUsuario', 'IdUsuario');
    }


    // Relacionamento com o modelo Carro (uma reserva está associada a um único carro)
    public function carro()
    {
        return $this->belongsTo(Carro::class, 'IdCarro', 'IdCarro');
    }
}
