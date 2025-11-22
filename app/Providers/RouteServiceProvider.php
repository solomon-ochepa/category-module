<?php

namespace Modules\Category\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'Category';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->central_domains();
        $this->tenant_domains();
    }

    /**
     * Define the central domains' routes for the application.
     */
    protected function central_domains(): void
    {
        $config = array_filter(config('tenancy.central_domains', []), fn ($i) => ($i !== '127.0.0.1') ? $i : null);
        $domains = (array) Arr::first($config) ?? [];

        foreach ($domains ?? [] as $domain) {
            Route::domain($domain)->group(function () {
                $this->mapApiRoutes();
                $this->mapWebRoutes();
            });
        }
    }

    /**
     * Define the tenant domains' routes for the application.
     */
    protected function tenant_domains(): void
    {
        Route::middleware('tenant')->group(function () {
            Route::middleware(['web'])
                ->group(fn () => (file_exists($i = module_path($this->name, 'routes/tenant/web.php'))) ? Route::group([], $i) : null);

            Route::middleware('api')
                ->prefix('api')
                ->name('api.')
                ->group(fn () => (file_exists($i = module_path($this->name, 'routes/tenant/api.php'))) ? Route::group([], $i) : null);
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->group(fn () => (file_exists($i = module_path($this->name, 'routes/web.php'))) ? Route::group([], $i) : null);
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->name('api.')
            ->group(fn () => (file_exists($i = module_path($this->name, 'routes/api.php'))) ? Route::group([], $i) : null);
    }
}
