<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Categories;
use App\Livewire\Dashboard;
use App\Livewire\Favorite;
use App\Livewire\Foods;
use App\Livewire\FormCalcul;
use App\Livewire\ListFoodUser;
use App\Livewire\StaticUser;
use App\Livewire\Welcome;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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

Route::get('/', Welcome::class)->name('welcome');
Route::get('/bmi', FormCalcul::class)->name('calcul.bmi');
Route::get('categories', Categories::class)->name('categories');
Route::get('food/{id}', Foods::class)->where(['id' => '[0-9]+'])->name('food');
Route::get('favorite', Favorite::class)->name('favorite')->middleware('auth');
Route::get('/static', StaticUser::class)->name('staticUser');

Route::middleware('auth')->group(function () {
});

Route::get('/dashboard',Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('favorite', Favorite::class)->name('favorite');
    Route::get('/lists', ListFoodUser::class)->name('user.listFood');

    // profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('test', function () {
    dd(Carbon::now()->month);
});
require __DIR__ . '/auth.php';
