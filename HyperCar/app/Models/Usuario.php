<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'USUARIO'; // Nome exato da tabela no MySQL

    // Se você não usar "id" como chave primária, especifique a chave primária
    protected $primaryKey = 'IdUsuario';

    // Desabilite os timestamps se não os estiver utilizando
    public $timestamps = false;

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = ['Nome', 'Email', 'Cpf', 'Endereco', 'Senha'];

    // Sobrescreva o método para pegar a senha
    public function getAuthPassword()
    {
        return $this->Senha; // Campo de senha na tabela USUARIO
    }

    // Sobrescreva o método para retornar o identificador (caso não use 'id')
    public function getAuthIdentifierName()
    {
        return 'IdUsuario'; // Nome do campo que é a chave primária
    }

    // Sobrescreva o método para retornar o valor do identificador
    public function getAuthIdentifier()
    {
        return $this->IdUsuario; // Campo de identificador
    }

    // Relacionamento com a tabela de reservas (Um usuário pode ter várias reservas)
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'IdUsuario', 'IdUsuario');
    }
}
