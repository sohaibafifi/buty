<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\Semestre;
use App\Models\Formation;
use App\Models\Department;
use App\Observers\GroupObserver;
use App\Observers\SemestreObserver;
use App\Observers\FormationObserver;
use App\Observers\DepartmentObserver;
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
        Department::observe(DepartmentObserver::class);
        Formation::observe(FormationObserver::class);
        Semestre::observe(SemestreObserver::class);
        Group::observe(GroupObserver::class);
    }
}
