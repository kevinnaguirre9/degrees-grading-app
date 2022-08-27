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
     * @var string
     */
    private string $gradesFilePath = __DIR__ . '/Grades.txt';

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
        $Grade = [$studentIdentificationCard, $phase, $grade];

        $fp = fopen($this->gradesFilePath, 'a'); //opens file in append mode

        fwrite($fp, implode(',', $Grade) . PHP_EOL);

        fclose($fp);
    }

    /**
     * @param string $studentIdentificationCard
     * @param int $phase
     * @return array|null
     */
    public function find(string $studentIdentificationCard, int $phase): ?array
    {
        return collect(self::$grades)->first(
            function($Grade) use ($studentIdentificationCard, $phase) {

                return data_get($Grade, 'code') == $studentIdentificationCard
                    && data_get($Grade, 'phase') == $phase;
            });
    }

    /**
     * @return array
     */
    private function getAllGradesFromTextFile() : array
    {
        $gradesTextData = array_map(
            'str_getcsv',
            file($this->gradesFilePath)
        );

        array_walk($gradesTextData, function(&$row) use ($gradesTextData) {
            $row = array_combine($gradesTextData[0], $row);
        });

        unset($gradesTextData[0]);

        return $gradesTextData;
    }
}
