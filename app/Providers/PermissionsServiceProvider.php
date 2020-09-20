<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
	    Blade::directive('role', function ($role) {
		    return "<?php if (auth()->check() && auth()->user()->hasRole({$role})): ?>";
	    });

	    Blade::directive('endrole', function ($role) {
		    return "<?php endif; ?>";
	    });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
