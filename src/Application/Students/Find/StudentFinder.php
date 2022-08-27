<?php

namespace TitlingQualifications\Application\Students\Find;

use TitlingQualifications\Domain\Students\Contracts\StudentRepository;
use TitlingQualifications\Domain\Students\Exceptions\StudentNotFound;

/**
 * Class StudentFinder
 */
final class StudentFinder
{
    /**
     * @param StudentRepository $repository
     */
    public function __construct(private StudentRepository $repository)
    {
    }

    /**
     * @param string $identificationCard
     * @return array
     * @throws StudentNotFound
     */
    public function __invoke(string $identificationCard): array
    {
        $Student = $this->repository->find($identificationCard);

        $this->ensureStudentExists($Student);

        return [];
    }

    /**
     * @param array $Student
     * @return void
     * @throws StudentNotFound
     */
    private function ensureStudentExists(array $Student)
    {
        if(empty($Student))
            throw new StudentNotFound("Student with given identification card not found");
    }
}
