<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController; 
use App\Http\Controllers\AdminAuthController; //<=controlador del pint
use App\Http\Middleware\PinMiddleware; //<=middleware del pin
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\GoogleLoginController;

use App\Models\Project;
Route::get('/', function () {
    //obtiene todos los proyectos de la base de datos y los pasa a la vista welcome
    $projects = Project::latest()->get();
    return view('welcome', compact('projects'));
    
});
  //Rutas de la puerta (Publicas para intentar entrar)
Route::get('/admin/login',[AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])
->name('admin.verify')
->middleware('throttle:5,1'); // Limita a 5 intentos de inicio de sesión por minuto por IP
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

  // Rutas del Panel de Administración (CMS),protegidas por el middleware
Route::prefix('admin')->middleware(PinMiddleware::class)->group(function () {
   
// ver lista de todos los proyectos
    Route::get('/cotizaciones',[LeadController::class, 'index'])->name('leads.index');
    Route::get('/proyectos', [ProjectController::class, 'index'])->name('projects.index');
    // Muestra el formulario para crear un proyecto
    Route::get('/proyectos/crear', [ProjectController::class, 'create'])->name('projects.create');
    // Recibe los datos del formulario y los guarda en la base de datos
    Route::post('/proyectos', [ProjectController::class, 'store'])->name('projects.store');
    //Elimina un proyecto especifico
    Route::delete('/proyectos/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    //  Mostrar el formulario para editar
    Route::get('/proyectos/{project}/editar', [ProjectController::class, 'edit'])->name('projects.edit');
    //  Actualizar (Update) los datos en la base de datos
    Route::put('/proyectos/{project}', [ProjectController::class, 'update'])->name('projects.update');
    });
    // Ruta para manejar la solicitud AJAX del chatbot
    Route::post('/chat/enviar', [ChatbotController::class, 'procesarChat'])
    ->name('chat.enviar')
    ->middleware('throttle:10,1'); // Limita a 10 solicitudes por minuto por IP
    
    //Autentificación de Google
    Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

    // temporal 
    Route::get('/limpiar-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return "¡Memoria caché limpia! Laravel ya puede leer Cloudinary.";
});
    