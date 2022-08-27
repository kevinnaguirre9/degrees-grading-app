<?php

namespace TitlingQualifications\Application\Grades\Create;

use TitlingQualifications\Application\Grades\Find\FindGradeQuery;
use TitlingQualifications\Application\Grades\Find\GradeFinder;
use TitlingQualifications\Application\Students\Find\StudentFinder;
use TitlingQualifications\Domain\Grades\Contracts\GradeRepository;
use TitlingQualifications\Domain\Grades\Exceptions\GradeAlreadyRegistered;
use TitlingQualifications\Domain\Students\Exceptions\StudentNotFound;

/**
 * Class GradeCreator
 *
 * @package TitlingQualifications\Application\Grades\Create
 */
final class GradeCreator
{
    /**
     * @param GradeRepository $repository
     * @param GradeFinder $gradeFinder
     * @param StudentFinder $studentFinder
     */
    public function __construct(
        private GradeRepository $repository,
        private GradeFinder             $gradeFinder,
        private StudentFinder           $studentFinder,
    )
    {
    }

    /**
     * @param CreateGradeCommand $command
     * @return void
     * @throws StudentNotFound
     * @throws GradeAlreadyRegistered
     */
    public function __invoke(CreateGradeCommand $command) : void
    {
        $studentIdentificationCard = $command->getStudentIdentificationCard();

        $phase = $command->getPhase();

        $Student = ($this->studentFinder)($studentIdentificationCard);

        $this->ensureGradeDoesntExist(
            new FindGradeQuery($studentIdentificationCard, $phase)
        );

        $this->repository->create(
            data_get($Student, 'code'),
            $command->getPhase(),
            $command->getGrade(),
        );
    }

    /**
     * @param FindGradeQuery $query
     * @return void
     * @throws GradeAlreadyRegistered
     */
    public function ensureGradeDoesntExist(FindGradeQuery $query)
    {
        $Grade = ($this->gradeFinder)($query);

        if($Grade)
            throw new GradeAlreadyRegistered('The phase grade has been already registered');
    }
}
