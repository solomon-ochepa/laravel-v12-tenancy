<?php

return [
    App\Providers\AppServiceProvider::class,
    Modules\Auth\App\Providers\FortifyServiceProvider::class,
    Modules\Tenancy\App\Providers\StanclTenancyServiceProvider::class,
];
