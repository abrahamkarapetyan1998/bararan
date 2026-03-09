<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WordsController;
use App\Models\Word;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [WordsController::class, 'index'])->middleware(['role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('words', WordsController::class);

Route::get('/', function () {
    $q = trim((string) request('q', ''));

    if ($q === '') {
        $words = Word::query()
            ->limit(5)
            ->get();
    } else {
        $words = Word::query()
            ->where('word', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->orderBy('word')
            ->limit(50)
            ->get();
    }

    return view('welcome', [
        'q' => $q,
        'words' => $words,
    ]);
})->name('search');

require __DIR__.'/auth.php';
