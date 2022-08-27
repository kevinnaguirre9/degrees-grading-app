<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use TitlingQualifications\Application\Students\Find\StudentFinder;
use TitlingQualifications\Domain\Students\Exceptions\StudentNotFound;

/**
 * Class StudentGetController
 *
 * @package App\Http\Controllers\V1
 */
final class StudentGetController extends Controller
{
    public function __construct(private StudentFinder $finder)
    {
    }

    /**
     * @param string $identificationCard
     * @param Request $request
     * @return JsonResponse
     * @throws StudentNotFound
     */
    public function __invoke(string $identificationCard, Request $request): JsonResponse
    {
        $student = ($this->finder)($identificationCard);

        return response()
            ->json($student);
    }
}
