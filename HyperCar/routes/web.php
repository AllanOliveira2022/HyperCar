<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\CarroController;


// Rota de Registro
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
//pagina inicial
Route::get('/home', [HomeController::class, 'index'])->name('home');//->midware('auth')
// Rota de Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
//rota inicio
Route::get('/inicio', [HomeController::class, 'Inicio'])->name('inicio')->middleware('auth');
//inicio admin
Route::get('/admin', [HomeController::class, 'admin'])->name('admin')->middleware('auth');
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/carros', [CarroController::class, 'index'])->name('admin.carros.index'); // Listar todos os carros
    Route::get('/carros/create', [CarroController::class, 'create'])->name('admin.carros.create'); // Formulário para cadastrar um novo carro
    Route::post('/carros', [CarroController::class, 'store'])->name('admin.carros.store'); // Salvar novo carro
    Route::get('/carros/{id}', [CarroController::class, 'show'])->name('admin.carros.show'); // Detalhes de um carro específico
    Route::get('/carros/{id}/edit', [CarroController::class, 'edit'])->name('admin.carros.edit'); // Formulário de edição de um carro
    Route::put('/carros/{id}', [CarroController::class, 'update'])->name('admin.carros.update'); // Atualizar um carro
    Route::delete('/carros/{id}', [CarroController::class, 'destroy'])->name('admin.carros.destroy'); // Remover um carro
    Route::get('/carros-disponiveis', [CarroController::class, 'carrosDisponiveis'])->name('admin.carros.disponiveis'); // Listar carros disponíveis
});

//reservas
Route::middleware(['auth'])->group(function () {
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
    Route::get('/reservas/minhas', [ReservaController::class, 'minhasReservas'])->name('reservas.minhas');
    Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
    Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('reservas.update');

    Route::post('/reservas/devolver', [ReservaController::class, 'devolver'])->name('reservas.devolver');
    Route::get('/reservas/devolucao', [ReservaController::class, 'processarDevolucao'])->name('reservas.processarDevolucao')->middleware('auth');

    //mostrar todas as reservas
    Route::get('/todas-reservas', [ReservaController::class, 'todasReservas'])->name('todas.reservas');

});

//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});

/*reservas
Route::middleware(['auth'])->group(function () {
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
});*/


//controle de carro
//mostrar todos os carros
Route::get('/total-carros', [CarroController::class, 'index'])->name('admin.total_carros');