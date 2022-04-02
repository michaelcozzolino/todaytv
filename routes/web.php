<?php

use App\Classes\ValidTvTime;
use App\Http\Controllers\ChannelsController;
use App\Http\Controllers\TvShowDetailsController;
use App\Models\TvGroup;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect(TvGroup::route(time: ValidTvTime::ON_AIR)))->name('home');

Route::get('/tv-show-details/{tvShowDetail}', [TvShowDetailsController::class, 'show'])->name('tv-show-details.show');

Route::get('/channels/tv-groups/{tvGroup}/times/{time}', [ChannelsController::class, 'index'])->name('channels.index');

Route::get('/channels/{channel}', [ChannelsController::class, 'show'])->name('channels.show');

Route::get('/privacy', fn () => view('privacy'))->name('privacy');
