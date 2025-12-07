<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;

Route::get('/', function () {
    return view('home');
});

Route::get('/create-letter', [LetterController::class, 'create'])->name('letters.create');
Route::post('/letters', [LetterController::class, 'store'])->name('letters.store');
Route::get('/letter/{id}', [LetterController::class, 'show'])->name('letters.show');
Route::get('/letters', [LetterController::class, 'index'])->name('letters.index');
Route::post('/letter/{id}/share', [LetterController::class, 'share'])->name('letters.share');

Route::post('/api/letters/sync', [LetterController::class, 'syncFromLocalStorage']);

use App\Http\Controllers\CardController;

Route::get('/create-card', [CardController::class, 'create'])->name('cards.create');
Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
Route::get('/card/{id}', [CardController::class, 'show'])->name('cards.show');
Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
Route::post('/card/{id}/share', [CardController::class, 'share'])->name('cards.share');

Route::post('/api/cards/sync', [CardController::class, 'syncFromLocalStorage']);


// routes/web.php

use App\Http\Controllers\PosterController;

Route::get('/create-poster', [PosterController::class, 'create'])->name('posters.create');
Route::post('/posters', [PosterController::class, 'store'])->name('posters.store');
Route::get('/poster/{id}', [PosterController::class, 'show'])->name('posters.show');
Route::get('/poster/{id}/download', [PosterController::class, 'download'])->name('posters.download');
Route::get('/posters', [PosterController::class, 'index'])->name('posters.index');
Route::post('/poster/{id}/share', [PosterController::class, 'share'])->name('posters.share');
Route::post('/poster/{id}/like', [PosterController::class, 'like'])->name('posters.like');

// API Routes
Route::post('/api/posters/sync', [PosterController::class, 'syncFromLocalStorage']);


use App\Http\Controllers\GiftListController;

Route::get('/create-giftlist', [GiftListController::class, 'create'])->name('giftlists.create');
Route::post('/giftlists', [GiftListController::class, 'store'])->name('giftlists.store');
Route::get('/giftlist/{id}', [GiftListController::class, 'show'])->name('giftlists.show');
Route::post('/giftlist/{id}/share', [GiftListController::class, 'share'])->name('giftlists.share');
Route::post('/giftlist/{listId}/reserve/{giftIndex}', [GiftListController::class, 'reserveGift'])->name('giftlists.reserve');
Route::get('/giftlists', [GiftListController::class, 'index'])->name('giftlists.index');

// API Routes
Route::post('/api/giftlists/sync', [GiftListController::class, 'syncFromLocalStorage']);


use App\Http\Controllers\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'index']);