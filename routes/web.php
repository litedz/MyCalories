<?php

use App\Enums\BMI_categorie;
use App\Http\Controllers\ProfileController;
use App\Livewire\Categories;
use App\Livewire\Favorite;
use App\Livewire\Foods;
use App\Livewire\FormCalcul;
use App\Livewire\Home;
use App\Livewire\ListFoodUser;
use App\Livewire\Welcome;
use App\Models\user_list;
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
Route::get('favorite', Favorite::class)->name('favorite');

Route::middleware('auth')->group(function () {
    Route::get('favorite', Favorite::class)->name('favorite');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/lists', ListFoodUser::class)->name('user.listFood');


route::get('/test', function () {

    dd(BMI_categorie::OBESE_1);
});

require __DIR__ . '/auth.php';
