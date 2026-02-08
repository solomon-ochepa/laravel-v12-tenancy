<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'tenant'])->group(function () {
    Route::get('/', function () {
        return '<p>This is your multi-tenant application.</p>
        <ul>
            <li>ID: '.tenant('id').'</li>
            <li>Name: '.tenant('name').'</li>
        </ul>';
    });
});
