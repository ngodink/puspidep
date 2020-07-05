<?php

namespace Modules\Web\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Gate;

use Modules\Web\Models\BlogPost;
use Modules\Web\Models\BlogCategory;
use Modules\Web\Models\Observers\BlogPostObserver;

class WebServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Web';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'web';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        View::share('BLOG_CATEGORIES', BlogCategory::withCount('posts')->get());

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->registerGates();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        // Load observers
        $this->registerObservers();
    }

    /**
     * Register the observers.
     */
    public function registerObservers()
    {
        BlogPost::observe(BlogPostObserver::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path($this->moduleName, 'Database/Factories'));
        }
    }

    /**
     * Register an additional gates.
     *
     * @return void
     */
    public function registerGates()
    {
        Gate::define('administrator', function ($user) {
            return $user->hasRoles(['root', 'admin']);
        });

        Gate::define('author', function ($user) {
            return $user->hasRoles(['root', 'author']);
        });

        Gate::define('editor', function ($user) {
            return $user->hasRoles(['root', 'editor']);
        });

        Gate::define('subscriber', function ($user) {
            return $user->hasRoles(['subscriber']);
        });

        Gate::define('admin', function ($user) {
            return $user->hasRoles(['root','admin','author','editor']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
