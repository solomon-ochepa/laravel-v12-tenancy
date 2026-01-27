<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return '<p>This is your multi-tenant application.</p>
        <ul>
            <li>ID: '.tenant('id').'</li>
            <li>Name: '.tenant('name').'</li>
        </ul>';
    });
});
