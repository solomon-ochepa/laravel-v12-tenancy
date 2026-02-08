<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nwidart\Modules\Traits\PathNamespace;

class DatabaseSeeder extends Seeder
{
    use PathNamespace, WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //

        if (tenant()) {
            $seeders = array_merge(
                glob('modules/*/database/seeders/TenantDatabaseSeeder.php'),
                glob('database/seeders/TenantDatabaseSeeder.php')
            );
            $classes = array_map(fn ($path) => $this->path_namespace(str_replace('.php', '', $path)), $seeders);

            $this->call($classes);
        }
    }
}
