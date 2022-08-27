<?php

namespace TitlingQualifications\Application\Grades\Find;

/**
 * Class FindGradeQuery
 *
 * @package TitlingQualifications\Application\Grades\Find
 */
final class FindGradeQuery
{
    /**
     * @param string $studentIdentificationCard
     * @param string $phase
     */
    public function __construct(
        private string $studentIdentificationCard,
        private string $phase,
    )
    {
    }

    /**
     * @return string
     */
    public function getStudentIdentificationCard(): string
    {
        return $this->studentIdentificationCard;
    }

    /**
     * @return string
     */
    public function getPhase(): string
    {
        return $this->phase;
    }
}
