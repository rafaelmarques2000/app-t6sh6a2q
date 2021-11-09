<?php

namespace App\Providers;

use App\Packages\Produto\Domain\Repository\ProdutoRepositoryInterface;
use App\Packages\Produto\Infra\Persistence\ProdutoRepository;
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
        $this->app->bind(ProdutoRepositoryInterface::class, fn() => app(ProdutoRepository::class));
    }
}
