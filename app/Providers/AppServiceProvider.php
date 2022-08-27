<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TitlingQualifications\Domain\Grades\Contracts\GradeRepository;
use TitlingQualifications\Domain\Students\Contracts\StudentRepository;
use TitlingQualifications\Infrastructure\Grades\Repositories\InMemoryGradeRepository;
use TitlingQualifications\Infrastructure\Students\Repositories\InMemoryStudentRepository;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentRepository::class, InMemoryStudentRepository::class);

        $this->app->bind(GradeRepository::class, InMemoryGradeRepository::class);
    }
}
