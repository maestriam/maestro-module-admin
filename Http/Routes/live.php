<?php

use Illuminate\Support\Facades\Route;
use Maestro\Admin\Views\Pages\NotFoundPage;

Route::get('/not-found', NotFoundPage::class)
    ->middleware(['users.auth'])
    ->name('maestro.admin.not-found');