<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = null;

    public function boot(): void
    {
        $this->configureRateLimiting();

        Route::middleware('api')
            ->group(function () {
                $this->authRoutes();
                $this->bookRoutes();
                $this->chapterRoutes();
                $this->libraryRoutes();
            });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return [
                Limit::perMinute(60)->by($request->user()?->id ?: $request->ip()),
                Limit::perSecond(10)->by($request->ip()),
            ];
        });
    }

    protected function authRoutes(): void
    {
        Route::prefix('api/v1')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v1/auth.php'));
    }
    protected function bookRoutes(): void
    {
        Route::prefix('api/v1/books')
            ->middleware('auth.jwt')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v1/books.php'));
    }

    protected function chapterRoutes(): void
    {
        Route::prefix('api/v1/books/chapters')
            ->middleware('auth.jwt')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v1/chapters.php'));
    }

    protected function libraryRoutes(): void
    {
        Route::prefix('api/v1/library')
            ->middleware('auth.jwt')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v1/library.php'));
    }
}
