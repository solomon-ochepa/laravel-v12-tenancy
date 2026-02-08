<?php

namespace Modules\Tenancy\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Tenancy\App\Models\Tenant;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = ['Demo', 'Tenant'];
        $db_prefix = config('tenancy.database.prefix');

        foreach ($tenants as $name) {
            $tenant = Tenant::firstOrCreate([
                'name' => $name,
            ], [
                'tenancy_db_name' => $db_prefix.Str::slug($name),
            ]);

            $tenant->domains()->firstOrCreate(['domain' => $name]);
        }
    }
}
