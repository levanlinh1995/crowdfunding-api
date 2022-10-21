<?php

namespace App\Providers;

use App\Contracts\CampaignRepository;
use App\Repositories\EloquentCampaignRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CampaignRepository::class, EloquentCampaignRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
