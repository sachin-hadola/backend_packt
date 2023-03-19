<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Book as BookInterface;
use App\Repositories\Book as BookRepository;
use App\Interfaces\Admin as AdminInterface;
use App\Repositories\Admin as AdminRepository;
use App\Interfaces\Services\Admin\Auth as AuthServiceInterface;
use App\Interfaces\Services\Admin\Book as BookServiceInterface;
use App\Services\Admin\Auth as AuthService;
use App\Services\Admin\Book as BookService;

use App\Interfaces\Services\Frontend\Book as BookServiceInterfaceFrontend;
use App\Services\Frontend\Book as BookServiceFrontend;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(BookInterface::class, function() {
            return new BookRepository();
        });
        app()->bind(AdminInterface::class, function() {
            return new AdminRepository();
        });
        app()->bind(AuthServiceInterface::class, function() {
            return new AuthService(new AdminRepository());
        });
        app()->bind(BookServiceInterface::class, function() {
            return new BookService(new BookRepository());
        });
        app()->bind(BookServiceInterfaceFrontend::class, function() {
            return new BookServiceFrontend(new BookRepository());
        });
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
