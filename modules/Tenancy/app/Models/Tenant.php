<?php

namespace Modules\Tenancy\App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Tenancy\Database\Factories\TenantFactory;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasFactory, HasUuids, Sluggable, SoftDeletes;

    /**
     * Get Custom columns (that wouldn't be stored in the data JSON column)
     */
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'slug',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the tenant's primary domain.
     */
    public function domain()
    {
        return $this->hasOne(Domain::class)->whereRaw("domain LIKE '%.%'");
    }

    /**
     * Get the tenant's default subdomain.
     */
    public function subdomain()
    {
        return $this->hasOne(Domain::class)->whereRaw("domain NOT LIKE '%.%'");
    }

    /**
     * Check if the tenant database exists.
     */
    public function database_exists(): bool
    {
        return $this->database()->manager()->databaseExists($this->database()->getName());
    }

    protected static function newFactory()
    {
        return TenantFactory::new();
    }
}
