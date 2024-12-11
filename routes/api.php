<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// Ruta para obtener el usuario autenticado (ya existente)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Ruta para obtener los estudiantes (para usuario autenticado)
Route::get('/students', function (Request $request) {
    return $request->user()->students;  // Devuelve los estudiantes asociados al usuario autenticado
})->middleware('auth:sanctum');  // Solo accesible por usuarios autenticados

// Rutas para User (ya existentes)
Route::get('/getUsers', [TestController::class, 'getUsers']);
Route::get('/getUser/{id}', [TestController::class, 'getUser']);
Route::post('/insertUser', [TestController::class, 'insertUser']);

// Rutas para Student (nuevas)
Route::get('/getStudents', [TestController::class, 'getStudents']);  // Obtener todos los estudiantes
Route::get('/getStudent/{id}', [TestController::class, 'getStudent']);  // Obtener un estudiante por ID
Route::post('/insertStudent', [TestController::class, 'insertStudent']);  // Insertar un nuevo estudiante

// Rutas para Informacion (ya existentes)
Route::get('/getInformacion', [TestController::class, 'getInformacion']);
Route::get('/getInformacionID/{id}', [TestController::class, 'getInformacionID']);
Route::post('/insertInformacion', [TestController::class, 'insertInformacion']);
