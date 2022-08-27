<?php

namespace TitlingQualifications\Application\Grades\Create;

/**
 * Class CreateGradeCommand
 *
 * @package TitlingQualifications\Application\Grades\Create
 */
final class CreateGradeCommand
{
    /**
     * @param string $studentIdentificationCard
     * @param string $phase,
     * @param string $grade
     */
    public function __construct(
        private string $studentIdentificationCard,
        private string $phase,
        private string $grade,
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

    /**
     * @return string
     */
    public function getGrade(): string
    {
        return $this->grade;
    }
}
