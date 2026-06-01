<?php

namespace App\Providers;

use App\Models\Subcategory;
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
    public function boot(): void
    {
        // Iniettiamo i dati corretti in base a dove si trova la sidebar
    View::composer('components.sidebar', function ($view) {
        // Recuperiamo il tipo passato al componente (es: <x-sidebar type="katana" />)
        $type = $view->getData()['type'] ?? null;

        if ($type === 'katana') {
            $view->with('subcategories', Subcategory::where('macro_categoria', 'katana')->get());
        } elseif ($type === 'martial') {
            $view->with('subcategories', Subcategory::where('macro_categoria', 'martial_arts')->get());
        } else {
            $view->with('subcategories', Subcategory::all());
        }
    });
    }
}
