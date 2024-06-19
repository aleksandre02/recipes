<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Route::get('/', function () {
//     Route::redirect('/', '/login');
// });
Route::redirect('/', '/login');

// Route::redirect('/', '/posts');
Route::resource('recipes', RecipeController::class);
Route::post('/comments/{recipe}', [CommentController::class, 'store'])->name('comments.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::post('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
Route::get('/recipes/search', [RecipeController::class, 'search'])->name('recipes.search');



Route::get('/dashboard', function () {
    return redirect()->route('recipes.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-detail', function () {
        return view('profile.userdetail');
    })->name('userdetail');
});
       

URL::forceScheme('https');

require __DIR__.'/auth.php';