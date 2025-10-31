<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Pass menus to the existing sidebar view
        View::composer('layouts.admin.sidebar', function ($view) {
            // Load top-level menus with children, ordered
            $menus = Menu::with('children.roles','roles') // eager load relationships
                        ->orderBy('order')
                        ->get()
                        ->filter(function($menu) {
                            // if menu has roles assigned -> keep; if no roles -> public
                            return true;
                        });
            $view->with('menus', $menus);
        });
    }
}
