<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        // Cek apakah visitor_id sudah ada di session, jika belum buat yang baru
        if (!session()->has('visitor_id')) {
            session(['visitor_id' => uniqid('visitor_', true)]);
        }
    }
}