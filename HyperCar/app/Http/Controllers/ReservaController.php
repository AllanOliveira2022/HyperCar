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
$reserva->Estatus = 'Pendente';
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
}

// Exibir minhas reservas
public function minhasReservas()
{
    // Obtém as reservas do usuário autenticado
    $reservas = Reserva::where('IdUsuario', auth()->user()->IdUsuario)->with('carro')->get();
    return view('Reservas.minhasReservas', compact('reservas'));
}
//mostrar todas reservas
public function todasReservas()
{
    $reservas = Reserva::with('carro', 'usuario')->get();
    return view('Admin.historicoReserva', compact('reservas'));
}


public function edit($id)
{
    // Obtém a reserva e verifica se pertence ao usuário autenticado
    $reserva = Reserva::where('IdReserva', $id)
                      ->where('IdUsuario', auth()->user()->IdUsuario)
                      ->firstOrFail();

    // Obtém todos os carros disponíveis, incluindo o carro atualmente reservado
    $carrosDisponiveis = Carro::where('Disponibilidade', 1)
                               ->orWhere('IdCarro', $reserva->IdCarro)
                               ->get();

    return view('Reservas.editarReserva', compact('reserva', 'carrosDisponiveis'));
}


public function update(Request $request, $id)
{
    // Valida os dados
    $request->validate([
        'IdCarro' => 'required|exists:carro,IdCarro',
        'DataInicio' => 'required|date',
        'DataFim' => 'required|date|after:DataInicio',
    ]);

    // Encontra a reserva e verifica se pertence ao usuário autenticado
    $reserva = Reserva::where('IdReserva', $id)
                      ->where('IdUsuario', auth()->user()->IdUsuario)
                      ->firstOrFail();

    $dataInicio = Carbon::parse($request->DataInicio);
    $dataFim = Carbon::parse($request->DataFim);
    $dias = $dataFim->diffInDays($dataInicio);
    $valorTotal = $dias * Carro::find($request->IdCarro)->PrecoDiaria;

    // Verifica se o carro foi alterado
    if ($request->IdCarro != $reserva->IdCarro) {
        // Libera o carro antigo
        $carroAntigo = Carro::find($reserva->IdCarro);
        $carroAntigo->Disponibilidade = 1;
        $carroAntigo->save();

        // Marca o novo carro como indisponível
        $novoCarro = Carro::find($request->IdCarro);
        $novoCarro->Disponibilidade = 0;
        $novoCarro->save();

        $reserva->IdCarro = $request->IdCarro;
    }

    // Atualiza as outras informações da reserva
    $reserva->DataInicio = $request->DataInicio;
    $reserva->DataFim = $request->DataFim;
    $reserva->ValorTotal = ($valorTotal) * (-1);
    $reserva->save();

    return redirect()->route('reservas.minhas')->with('success', 'Reserva atualizada com sucesso!');
}

//devolução de reserva

public function processarDevolucao()
{
    // Obter todas as reservas pendentes ou ativas
    $reservasAtivas = Reserva::where('Estatus', 'Pendente')->with('carro', 'usuario')->get();

    return view('Admin.devolucao', compact('reservasAtivas'));
}

public function devolver(Request $request)
{
    
    $request->validate([
        'IdReserva' => 'required|exists:reserva,IdReserva',
    ]);

    $reserva = Reserva::findOrFail($request->IdReserva);

    // Verificar se a reserva já foi concluída
    if ($reserva->Estatus === 'Devolvido') {
        return redirect()->back()->with('error', 'Essa reserva já foi devolvida.');
    }

    // Verificar se a data de devolução é válida
    $dataDevolucao = Carbon::now();
    $dataDevolucao = $request->dataDevolucao;
    if ($dataDevolucao < $reserva->DataInicio) {
        return redirect()->back()->with('error', 'A data de devolução não pode ser anterior à data de início.');
    }

    // Calcular o valor total (se necessário, incluir cálculos de multas)
    // ...

    // Atualizar a reserva
    $reserva->DataDevolucao = $dataDevolucao;
    $reserva->Estatus = 'Devolvido';
    $reserva->save();

    // Atualizar a disponibilidade do carro
    $carro = Carro::findOrFail($reserva->IdCarro);
    $carro->Disponibilidade = 1;
    $carro->save();
    session()->flash('devolucao_sucesso', 'Devolução realizada com sucesso!');

    // Adicionar log de auditoria
    \Log::info("Reserva #{$reserva->IdReserva} devolvida por " . auth()->user()->name . " em " . $dataDevolucao);

    // Enviar notificações (opcional)
    // ...

    return redirect()->route('reservas.processarDevolucao')->with('success', 'Carro devolvido com sucesso!');
}


}