<?php

namespace TitlingQualifications\Infrastructure\Grades\Repositories;

use TitlingQualifications\Domain\Grades\Contracts\GradeRepository;

/**
 * Class InMemoryGradeRepository
 *
 * @package TitlingQualifications\Infrastructure\Grades\Repositories
 */
final class InMemoryGradeRepository implements GradeRepository
{
    /**
     * @var array
     */
    private static array $grades;

    /**
     *
     */
    public function __construct()
    {
        self::$grades = $this->getAllGradesFromTextFile();
    }

    /**
     * @param string $studentIdentificationCard
     * @param int $phase
     * @param string $grade
     * @return void
     */
    public function create(string $studentIdentificationCard, int $phase, string $grade): void
    {
        // TODO: Implement create() method.
    }

    /**
     * @param string $studentIdentificationCard
     * @param int $phase
     * @return array|null
     */
    public function find(string $studentIdentificationCard, int $phase): ?array
    {
        return collect(self::$grades)
            ->first(function($Grade) use ($studentIdentificationCard, $phase) {

                return data_get($Grade, 'code') === $studentIdentificationCard
                    && data_get($Grade, 'phase') === $phase;
            });
    }

    /**
     * @return array
     */
    private function getAllGradesFromTextFile() : array
    {
        //Get comma separated lines as an array element
        $gradesTextData = array_map(
            'str_getcsv',
            file(__DIR__ . "/Grades.txt")
        );

        //Combine header as keys with rows as elements
        array_walk($gradesTextData, function(&$row) use ($gradesTextData) {
            $row = array_combine($gradesTextData[0], $row);
        });

        unset($gradesTextData[0]); //remove header

        return $gradesTextData;
    }
}
