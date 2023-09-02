<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Categories;
use App\Livewire\Foods;
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
Route::get('/bmi', Home::class)->name('calcul.bmi');
Route::get('categories', Categories::class)->name('categories');
Route::get('food/{id}', Foods::class)->name('food');

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
    $s = collect(user_list::with('food')->where('user_id', auth()->user()->id)->get())->groupBy(function ($val) {
        return Carbon::parse($val->created_at)->format('Y m d');
    })->toArray();

    foreach ($s as $key => $value) {
        $totalKcal = 0;
       
        foreach ($value as $k => $v) {
            // $s[$key]['Total_kcal'] = $v->kcal;
            $totalKcal += $v['kcal'];
        }

        $s[$key]['TotalKcal']= $totalKcal;
    }

    dd($s);
});

require __DIR__ . '/auth.php';
