<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Jalur ke "home" aplikasi kamu.
     *
     * Biasanya dipakai saat redirect setelah login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Daftarkan route aplikasi.
     */
    public function boot(): void
{
    $this->routes(function () {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
        
    });
}


}
