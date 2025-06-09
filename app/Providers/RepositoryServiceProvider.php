<?php

namespace App\Providers;

use App\Repositories\Read\Task\TaskReadRepository;
use App\Repositories\Read\Task\TaskReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepository;
use App\Repositories\Write\Task\TaskWriteRepository;
use App\Repositories\Write\Task\TaskWriteRepositoryInterface;
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

        $this->app->singleton(
            TaskReadRepositoryInterface::class,
            TaskReadRepository::class
        );

        $this->app->singleton(
            TaskWriteRepositoryInterface::class,
            TaskWriteRepository::class
        );
    }
}
