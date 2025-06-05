<?php

namespace App\Providers;

use Illuminate\pagination\paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        // Hapus penguncian aplikasi, tidak perlu cek file activated.key lagi
        // if (!File::exists(storage_path('activated.key')) && !Request::is('activate*')) {
        //     Redirect::to('/activate')->send();
        // }
    }
}
