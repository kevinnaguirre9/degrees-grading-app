<?php

namespace TitlingQualifications\Domain\Students\Contracts;

/**
 * Interface StudentRepository
 */
interface StudentRepository
{
    /**
     * @param array $Student
     * @return void
     */
    public function save(array $Student): void;

    /**
     * @param string $identificationCard
     * @return array
     */
    public function find(string $identificationCard): array;
}
