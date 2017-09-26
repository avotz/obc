<?php

namespace App\Providers;
use App\Country;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $countries = getCountries();

        View::share('countries', $countries);
        
        // view()->composer('layouts.app', function ($view)
        // {
        //      $appointments = \App\Appointment::with('user','patient')->where('user_id', auth()->id())->where('status', 0)->where('patient_id','<>',0)->where('viewed', 0)->limit(10);
               
            

        //     $newAppointments = $appointments->get();

           
        //     $view->with('newAppointments', $newAppointments);
        // });
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
