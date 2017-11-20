<?php

namespace App\Providers;
use App\Country;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
        
        $countries = $this->getCountries();

        View::share('countries', $countries);
        
        view()->composer('requests.partials.form', function ($view)
        {
            $creditDays = \App\CreditDays::all();
            $sectors = \App\Sector::get()->toTree();
            $deliveryDays = range(1, 100);
           
            $view->with(compact('creditDays','sectors','deliveryDays'));
        });
        view()->composer('quotations.partials.form', function ($view)
        {
            $creditDays = \App\CreditDays::all();
            $sectors = \App\Sector::get()->toTree();
            $deliveryDays = range(1, 100);
           
            $view->with(compact('creditDays','sectors','deliveryDays'));
        });
        view()->composer('credits.partials.form', function ($view)
        {
            $creditDays = \App\CreditDays::all();
            
           
            $view->with(compact('creditDays'));
        });
        view()->composer('creditRequests.partials.form', function ($view)
        {
            $creditDays = \App\CreditDays::all();
            
           
            $view->with(compact('creditDays'));
        });
         view()->composer('credit.credits.partials.form', function ($view)
        {
            $creditDays = \App\CreditDays::all();
            
           
            $view->with(compact('creditDays'));
        });
         view()->composer('credit.creditRequests.partials.form', function ($view)
        {
            $creditDays = \App\CreditDays::all();
            
           
            $view->with(compact('creditDays'));
        });
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

     /**
     * Fetch the collection of site countries.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
     protected function getCountries()
     {
        
        if(Schema::hasTable("countries")){ return Country::all(); }

        return [];
        // return Permission::with('users')->get();
     }
}
