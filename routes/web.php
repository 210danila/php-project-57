<?php

use Illuminate\Support\Facades\{Route, Log};
use App\Http\Controllers\{TaskStatusController, TaskController, LabelController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('root');

Route::resource('task_statuses', TaskStatusController::class);
Route::resource('labels', LabelController::class);
Route::resource('tasks', TaskController::class);

require __DIR__ . '/auth.php';
