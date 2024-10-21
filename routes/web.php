<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EscolaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoPagamentoController;

// Página inicial (opcional)
Route::get('/', function () {
    return view('welcome');
});

// Página de Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Página de Registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Página de Reset de Senha
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Página de Redefinição de Senha
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Página Home (após login)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('escolas', EscolaController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('vendas', VendaController::class);
Route::resource('clientes', ClienteController::class);

Route::post('/processar-pagamento', [TipoPagamentoController::class, 'processarPagamento'])->name('processar.pagamento');
Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
Route::get('clientes/autocomplete', [ClienteController::class, 'autocomplete'])->name('clientes.autocomplete');
