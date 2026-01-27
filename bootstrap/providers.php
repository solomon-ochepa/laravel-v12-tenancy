<?php

return [
    App\Providers\AppServiceProvider::class,
    Modules\Auth\App\Providers\FortifyServiceProvider::class,
    App\Providers\TenancyServiceProvider::class,
];
