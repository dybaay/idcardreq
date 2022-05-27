<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        $quotes = $this->getQuotes();
        View::share('quotes',$quotes);
    }

    public function getQuotes(): array
    {
        $quotes = config("quotes");
        shuffle($quotes);
        return $quotes[0];
    }
}
