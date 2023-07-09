<?php

use Illuminate\Support\Facades\{Route};
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

Route::view('/', 'welcome')->name('root');

Route::resources([
    'task_statuses' => TaskStatusController::class,
    'labels' => labelController::class,
    'tasks' => TaskController::class,
]);

require __DIR__ . '/auth.php';
