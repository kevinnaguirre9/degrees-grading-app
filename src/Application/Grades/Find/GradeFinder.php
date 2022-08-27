<?php

namespace TitlingQualifications\Application\Grades\Find;

use TitlingQualifications\Domain\Grades\Contracts\GradeRepository;

/**
 * Class GradeFinder
 */
final class GradeFinder
{
    /**
     * @param GradeRepository $repository
     */
    public function __construct(private GradeRepository $repository)
    {
    }

    /**
     * @param FindGradeQuery $query
     * @return array|null
     */
    public function __invoke(FindGradeQuery $query): ?array
    {
        return $this->repository->find(
            $query->getStudentIdentificationCard(),
            $query->getPhase(),
        );
    }
}
