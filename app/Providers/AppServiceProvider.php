<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\AbstractPaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        // Va nous permettre d'utiliser la directive @admin dans nos vues blade pour verifier que le user est bien un admin
        Blade::if('admin',function(){
            return auth()->check() && auth()->user()->role ==="admin";
        });

        // Ici on ajoute un filter admin ou owner (propriétaire de la ressource)
        Blade::if('adminOrOwner',function($id){

            return auth()->check() && (auth()->user()->role ==="admin" || auth()->id() === $id);
        });

        AbstractPaginator::defaultView("pagination::bootstrap-4");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
