<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Carro;
use App\Models\Usuario;
use Carbon\Carbon; 

class ReservaController extends Controller
{
    // Exibir veículos disponíveis para reserva
    public function index()
    {
        $carrosDisponiveis = Carro::where('Disponibilidade', 1)->get();
        return view('Cliente.reservas', compact('carrosDisponiveis'));
    }

    // Processar reserva
    public function store(Request $request)
{
    // Validar os dados de entrada
    $request->validate([
        'IdCarro' => 'required|exists:carro,IdCarro', // Valida se o carro existe na tabela carros
        'DataInicio' => 'required|date',
        'DataFim' => 'required|date|after:DataInicio', // Data de fim deve ser posterior à data de início
    ]);

    // Obter o carro selecionado
    $carro = Carro::find($request->IdCarro);

    // Verificar se o carro está disponível
    if ($carro->Disponibilidade == 0) {
        return redirect()->back()->with('error', 'Este carro não está disponível.');
    }

    $dataInicio = Carbon::parse($request->DataInicio);
$dataFim = Carbon::parse($request->DataFim);

// Adicionar log para depuração
\Log::info('Data Início: ' . $dataInicio);
\Log::info('Data Fim: ' . $dataFim);

// Verificar se DataFim é posterior a DataInicio
if ($dataFim <= $dataInicio) {
    return redirect()->back()->with('error', 'A data de fim deve ser posterior à data de início.');
}

// Calcular os dias e o valor total
$dias = $dataFim->diffInDays($dataInicio); // Retorna a diferença em dias
$valorTotal = $dias * $carro->PrecoDiaria;
$reserva = new Reserva();
$reserva->IdUsuario = auth()->user()->IdUsuario; // Assumindo que o usuário esteja autenticado
$reserva->IdCarro = $request->IdCarro;
$reserva->DataInicio = $request->DataInicio;
$reserva->DataFim = $request->DataFim;
$reserva->ValorTotal = ($valorTotal) * (-1);

try {
    $reserva->save();
} catch (\Exception $e) {
    return redirect()->back()->with('error', 'Erro ao salvar a reserva: ' . $e->getMessage());
}

// Atualizar a disponibilidade do carro
$carro->Disponibilidade = 0; // Marcar o carro como indisponível
$carro->save();

// Redirecionar com sucesso
return redirect()->route('reservas.index')->with('success', 'Reserva realizada com sucesso!');
}}