<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use DB;
use View;
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
        View()->composer('layouts/*', function($view) {
            if( Auth::check()) {
                $uid = Auth()->user()->id;
                $set_menu = DB::select("select * from set_menu m where m.prid=0
                order by m.pg_order ");
                foreach($set_menu as $menu) {
                    $menu->childs=DB::select("select * from set_menu m
                    where m.is_visible=1 and m.prid=$menu->id
                    order by m.pg_order ");
                }
                View::share(compact('set_menu'));
            }
        });
    }
}
