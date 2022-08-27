<?php

namespace TitlingQualifications\Infrastructure\Students\Repositories;

use TitlingQualifications\Domain\Students\Contracts\StudentRepository;

/**
 * Class InMemoryStudentRepository
 */
final class InMemoryStudentRepository implements StudentRepository
{
    /**
     * @var array
     */
    private static array $Students = [];

    /**
     * @param array $Student
     * @return void
     */
    public function save(array $Student): void
    {
        // TODO: Implement save() method.
    }

    /**
     * @param string $identificationCard
     * @return array
     */
    public function find(string $identificationCard): array
    {
        return [];
    }
}
