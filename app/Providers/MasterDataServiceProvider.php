<?php

namespace App\Providers;

use App\Services\Access\Access;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AccessServiceProvider
 * @package App\Providers
 */
class MasterDataServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Package boot method
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Register service provider bindings
     */
    public function registerBindings()
    {

        /**
         * Master Data Category
         */
        $this->app->bind(
            \App\Repositories\Backend\Master\Category\CategoryContract::class,
            \App\Repositories\Backend\Master\Category\EloquentCategoryRepository::class
        );
        $this->app->bind(
            \App\Repositories\Backend\Master\Frame\FrameContract::class,
            \App\Repositories\Backend\Master\Frame\EloquentFrameRepository::class
        );
        $this->app->bind(
            \App\Repositories\Backend\Master\Hairstyle\HairstyleContract::class,
            \App\Repositories\Backend\Master\Hairstyle\EloquentHairstyleRepository::class
        );
    }

}