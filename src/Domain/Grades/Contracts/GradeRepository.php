<?php

namespace TitlingQualifications\Domain\Grades\Contracts;

/**
 * Interface GradeRepository
 *
 * @package TitlingQualifications\Domain\Grades\Contracts
 */
interface GradeRepository
{
    /**
     * @param string $studentIdentificationCard
     * @param int $phase
     * @param string $grade
     * @return void
     */
    public function create(string $studentIdentificationCard, int $phase, string $grade): void;

    /**
     * @param string $studentIdentificationCard
     * @param int $phase
     * @return array|null
     */
    public function find(string $studentIdentificationCard, int $phase): ?array;

}
