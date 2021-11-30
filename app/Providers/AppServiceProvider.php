<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepository;
use App\Repositories\User\EloquentUser;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Category\EloquentCategory;
use App\Repositories\Product\EloquentProduct;
use App\Repositories\Comment\EloquentComment;
use App\Repositories\Rate\EloquentRate;
use App\Repositories\Rate\RateRepository;

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
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(CategoryRepository::class, EloquentCategory::class);
        $this->app->singleton(ProductRepository::class, EloquentProduct::class);
        $this->app->singleton(CommentRepository::class, EloquentComment::class);
        $this->app->singleton(RateRepository::class, EloquentRate::class);

    }
}
