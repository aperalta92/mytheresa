<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mytheresa\Category\Domain\Contracts\CategoryRepositoryContract;
use Mytheresa\Category\Infrastructure\Repositories\EloquentCategoryRepository;
use Mytheresa\Discount\Domain\Contracts\DiscountRepositoryContract;
use Mytheresa\Discount\Infrastructure\Repositories\EloquentDiscountRepository;
use Mytheresa\Product\Domain\Contracts\ProductRepositoryContract;
use Mytheresa\Product\Infrastructure\Repositories\EloquentProductRepository;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProductRepositoryContract::class => EloquentProductRepository::class,
        DiscountRepositoryContract::class => EloquentDiscountRepository::class,
        CategoryRepositoryContract::class => EloquentCategoryRepository::class,
    ];
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
        //
    }
}
