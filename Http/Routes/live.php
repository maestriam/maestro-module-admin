<?php

use Illuminate\Support\Facades\Route;
use Maestro\Admin\Views\Pages\NotFoundPage;
use Maestro\Admin\Views\Pages\ServerErrorPage;

Route::get('/not-found', NotFoundPage::class)
    ->middleware(['users.auth'])
    ->name('maestro.admin.not-found');

Route::get('/error', ServerErrorPage::class)
    ->middleware(['users.auth'])
    ->name('maestro.admin.server-error');