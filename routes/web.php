<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopicTemplateController;
use App\Http\Controllers\InputTemplateController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ReactionController;
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

Route::get('/apps', [App\Http\Controllers\AppController::class, 'index'])->name('apps.index');


Route::get('/apps/{app}/topics', [App\Http\Controllers\TopiclistContrller::class, 'index'])->name('apps.topic.index');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/apps/create', [AppController::class, 'create'])->name('apps.create');
    Route::get('/apps/{appId}/topic-templates/create', [TopicTemplateController::class, 'create'])->name('apps.topic-templates.create');
    Route::post('/apps/{appId}/topic-templates', [TopicTemplateController::class, 'store'])->name('apps.topic-templates.store');
    Route::get('/apps/{appId}/topic-templates/{templateId}/edit', [TopicTemplateController::class, 'edit'])->name('apps.topic-templates.edit');
    Route::put('/apps/{appId}/topic-templates/{templateId}', [TopicTemplateController::class, 'update'])->name('apps.topic-templates.update');
    Route::post('/apps/{appId}/topic-templates/{templateId}/inputs', [InputTemplateController::class, 'store'])->name('apps.topic-templates.inputs.store');
    Route::get('/apps/{appId}/topic-templates/{templateId}/inputs/create', [InputTemplateController::class, 'create'])->name('apps.topic-templates.inputs.create');
    Route::post('/apps', [AppController::class, 'store'])->name('apps.store');
    Route::post('/apps/{appId}/topics/{topicId}/posts/{postId}/reactions', [ReactionController::class, 'store'])->name('apps.topics.posts.reactions.store');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});
Route::get('/apps/{appId}/topic-templates', [TopicTemplateController::class, 'index'])->name('apps.topic-templates.index');

Route::get('/apps/{appId}/topics/create', [TopicController::class, 'create'])->name('apps.topics.create');
Route::post('/apps/{appId}/topics', [TopicController::class, 'store'])->name('apps.topics.store');

Route::get('/apps/{appId}/topics/{topicId}', [TopicController::class, 'show'])->name('apps.topics.show');
Route::post('/apps/{appId}/topics/{topicId}', [PostController::class, 'store'])->name('apps.topics.posts.store');
Route::get('/apps/{appId}topics/{topicId}/posts', [PostController::class, 'index'])->name('apps.topics.posts.index');

Route::get('/apps/{app}', [AppController::class, 'show'])->name('apps.show');

//Route::get('/apps/{appId}', [AppController::class, 'show'])->name('apps.show')->where(['appId' => '[0-9]+']);