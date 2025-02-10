<?php

namespace App\Providers;

use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepository;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use App\Repositories\Write\User\UserWriteRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
          UserReadRepositoryInterface::class,
          UserReadRepository::class
        );

        $this->app->singleton(
            UserWriteRepositoryInterface::class,
            UserWriteRepository::class
        );
    }
}
