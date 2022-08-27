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
    private static array $Students;

    /**
     *
     */
    public function __construct()
    {
        self::$Students = $this->getAllStudentsFromTextFile();
    }

    /**
     * @param array $Student
     * @return void
     */
    public function save(array $Student): void
    {

    }

    /**
     * @param string $identificationCard
     * @return array|null
     */
    public function find(string $identificationCard): ?array
    {
        return collect(self::$Students)
            ->first(fn($Student) => data_get($Student, 'code') === $identificationCard);
    }

    /**
     * @return array
     */
    private function getAllStudentsFromTextFile() : array
    {
        //Get comma separated lines as an array element
        $studentsTextData = array_map(
            'str_getcsv',
            file(__DIR__ . "/Students.txt")
        );

        //Combine header as keys with rows as elements
        array_walk($studentsTextData, function(&$row) use ($studentsTextData) {
            $row = array_combine($studentsTextData[0], $row);
        });

        unset($studentsTextData[0]); //remove header

        return $studentsTextData;
    }
}
