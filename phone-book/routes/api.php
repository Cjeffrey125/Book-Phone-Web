<?php

use App\Http\Controllers\PhoneBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('new_contact', [PhoneBookController::class, 'store']);
Route::get('contacts', [PhoneBookController::class, 'index']);
Route::get('contacts/{contact}', [PhoneBookController::class, 'show']);
Route::put('contacts/update/{contact}', [PhoneBookController::class, 'update']);
Route::delete('contacts/delete/{contact}', [PhoneBookController::class, 'destroy']);
