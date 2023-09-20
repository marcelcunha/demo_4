<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Book\Creation as BookCreation;
use App\Livewire\Book\Edition as BookEdition;
use App\Livewire\Book\Index as BookIndex;
use App\Livewire\Book\Show as BookShow;
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

Route::middleware('auth')->group(function () {
    Route::prefix('livros')->group(function () {
        Route::get('/', BookIndex::class)->name('books.index');
        Route::get('/adicionar', BookCreation::class)->name('books.create');
        Route::get('/{book}', BookShow::class)->name('books.show');
        Route::get('/{book}/editar', BookEdition::class)->name('books.edit');
    });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
