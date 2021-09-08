<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicTemplateController;
use App\Http\Controllers\InputTemplateController;
use App\Http\Controllers\TopicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/apps', [App\Http\Controllers\AppController::class, 'index'])->name('apps.index');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/apps/{appId}/topic-templates/create', [TopicTemplateController::class, 'create'])->name('apps.topic-templates.create');
    Route::post('/apps/{appId}/topic-templates', [TopicTemplateController::class, 'store'])->name('apps.topic-templates.store');
    Route::get('/apps/{appId}/topic-templates/{templateId}/edit', [TopicTemplateController::class, 'edit'])->name('apps.topic-templates.edit');
    Route::put('/apps/{appId}/topic-templates/{templateId}', [TopicTemplateController::class, 'update'])->name('apps.topic-templates.update');
    Route::post('/apps/{appId}/topic-templates/{templateId}/inputs', [InputTemplateController::class, 'store'])->name('apps.topic-templates.inputs.store');
    Route::get('/apps/{appId}/topic-templates/{templateId}/inputs/create', [InputTemplateController::class, 'create'])->name('apps.topic-templates.inputs.create');
});
Route::get('/apps/{appId}/topic-templates', [TopicTemplateController::class, 'index'])->name('apps.topic-templates.index');

Route::get('/apps/{appId}/topics/create', [TopicController::class, 'create'])->name('apps.topics.create');
Route::post('/apps/{appId}/topics', [TopicController::class, 'store'])->name('apps.topics.store');