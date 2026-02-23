<?php

use App\Http\Controllers\MembershipController;
use Illuminate\Support\Facades\Route;

Route::prefix('membership')->name('membership.')->group(function () {
        Route::get('/index', [MembershipController::class, 'index'])->name('index');
        Route::get('/get_members', [MembershipController::class, 'getMembers'])->name('get.members');
        Route::get('/post_members', [MembershipController::class, 'postMembers'])->name('post.members');
        
    });