<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;

class CarroController extends Controller
{
    // Listar todos os carros
    public function index()
{
    // Obtenha os carros e calcule os totais
    $carros = Carro::all();

    // Passa as variáveis para a view
    return view('Admin.mostrarcarro', compact('carros'));
}


    // Exibir formulário para cadastrar um novo carro
    public function create()
    {
        return view('Admin.cadastrarcarro');
    }

    // Salvar o novo carro no banco de dados
    public function store(Request $request)
{
    // Validação dos dados de entrada
    $request->validate([
        'Modelo' => 'required|string|max:50',
        'Tipo' => 'required|string|max:200',
        'Disponibilidade' => 'required|integer|in:0,1',
        'Placa' => 'required|string|size:7|unique:carros,Placa',
        'Quilometragem' => 'required|integer|min:0',
        'AnoFabricacao' => 'required|integer|min:0',
        'PrecoDiaria' => 'required|numeric|min:0',
    ]);

    // Verifique os dados recebidos
// Isso exibirá todos os dados enviados pelo formulário

    $carro = new Carro();
    $carro->Modelo = $request->Modelo;
    $carro->Tipo = $request->Tipo;
    $carro->Disponibilidade = $request->Disponibilidade;
    $carro->Placa = $request->Placa;
    $carro->Quilometragem = $request->Quilometragem;
    $carro->AnoFabricacao = $request->AnoFabricacao;
    $carro->PrecoDiaria = $request->PrecoDiaria;

    try {
        $carro->save();
        return redirect()->route('admin.carros.index')->with('success', 'Carro cadastrado com sucesso!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Erro ao salvar o carro: ' . $e->getMessage());
    }
}

    // Exibir detalhes de um carro específico
    public function show($id)
    {
        $carro = Carro::findOrFail($id);
        return view('Admin.mostrarcarro', compact('carro'));
    }

    // Exibir formulário para editar um carro
    public function edit($id)
    {
        $carro = Carro::findOrFail($id);
        return view('Admin.editarcarro', compact('carro'));
    }

    // Atualizar um carro no banco de dados
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'Modelo' => 'required|string|max:50',
            'Tipo' => 'required|string|max:200',
            'Disponibilidade' => 'required|integer|in:0,1',
            'Placa' => 'required|string|size:7|unique:carros,Placa,' . $id . ',IdCarro',
            'Quilometragem' => 'required|integer|min:0',
            'AnoFabricacao' => 'required|integer|min:0',
            'PrecoDiaria' => 'required|numeric|min:0',
        ]);

        // Atualização do carro
        $carro = Carro::findOrFail($id);
        $carro->update([
            'Modelo' => $request->Modelo,
            'Tipo' => $request->Tipo,
            'Disponibilidade' => $request->Disponibilidade,
            'Placa' => $request->Placa,
            'Quilometragem' => $request->Quilometragem,
            'AnoFabricacao' => $request->AnoFabricacao,
            'PrecoDiaria' => $request->PrecoDiaria,
        ]);

        return redirect()->route('admin.carros.index')->with('success', 'Carro atualizado com sucesso!');
    }

    // Remover um carro do banco de dados
    public function destroy($id)
    {
        $carro = Carro::findOrFail($id);
        $carro->delete();

        return redirect()->route('admin.carros.index')->with('success', 'Carro excluído com sucesso!');
    }

    // Filtrar carros disponíveis
    public function carrosDisponiveis()
    {
        $carrosDisponiveis = Carro::where('Disponibilidade', 1)->get();
        return view('admin.carros.disponiveis', compact('carrosDisponiveis'));
    }

    //controle de carros
    public function verificarTotalCarros()
    {
        // Utilizando Eloquent para contar o total de carros
        $totalCarros = Carro::count(); // Contagem do número de carros
        // Retorna o total de carros ou passa para a view
        return view('Admin.admin', compact('totalCarros'));
    }

    // ... outros métodos do controller

}
