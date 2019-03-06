<?php

namespace IAMProperty\MultiAuth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class MultiAuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerConfig();

        $this->app->when(HintStore::class)
            ->needs('$hintName')
            ->give(function () {
                return config('multiauth.guard_hint_name');
            });

        $this->app->bind(AuthManager::class, function (Application $app) {
            return new AuthManager($app);
        });
    }

    private function registerConfig(): void
    {
        $this->publishes([
            __DIR__.'/../config/multiauth.php' => config_path('multiauth.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/../config/multiauth.php', 'multiauth');
    }
}
