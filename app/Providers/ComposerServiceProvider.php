<?php

namespace App\Providers;

use App\Http\Controllers\Widgets\SearchWidgetController;
use App\Http\Models\Category\CategoryNesting;
use App\ModelsDB\Currency;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->menuLoad();
        $this->selectLoad();
    }

    public function menuLoad(){
        View::composer('partials.header', function ($view){
            $view->with('categoryNested', CategoryNesting::getTree());
        });
    }

    public function selectLoad(){
        View::composer('partials.header', function ($view){
            $view->with('currencies', Currency::all());
        });
    }

}
