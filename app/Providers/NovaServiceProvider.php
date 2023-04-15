<?php

namespace App\Providers;

use App\Nova\Dashboards\OrderInsights;
use App\Observers\ProductObserver;
use App\Models\Product;
use Eminiarts\NovaPermissions\NovaPermissions;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(static function () {
            app()->setLocale('ru');
            Product::observe(ProductObserver::class);
        });

        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return $user->hasAnyRole(['super-admin', 'admin', 'manager']);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return Help[]
     *
     * @psalm-return list{Help}
     */
    protected function cards()
    {
        return [
            new Help,
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return OrderInsights[]
     *
     * @psalm-return list{OrderInsights}
     */
    protected function dashboards()
    {
        return [
            new OrderInsights()
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return NovaPermissions[]
     *
     * @psalm-return list{NovaPermissions}
     */
    public function tools()
    {
        return [
            (new NovaPermissions())->canSee(function ($request) {
                return $request->user()->hasAnyRole(['super-admin', 'admin']);
            }),
        ];
    }
}
