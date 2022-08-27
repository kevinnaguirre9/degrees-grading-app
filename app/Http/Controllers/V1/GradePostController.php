<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use TitlingQualifications\Application\Grades\Create\CreateGradeCommand;
use TitlingQualifications\Application\Grades\Create\GradeCreator;
use TitlingQualifications\Domain\Grades\Exceptions\GradeAlreadyRegistered;
use TitlingQualifications\Domain\Students\Exceptions\StudentNotFound;

/**
 * Class GradePostController
 *
 * @package App\Http\Controllers\V1
 */
final class GradePostController extends Controller
{
    /**
     * @param GradeCreator $creator
     */
    public function __construct(private GradeCreator $creator)
    {
    }

    /**
     * @param string $studentIdentificationCard
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws GradeAlreadyRegistered
     * @throws StudentNotFound
     */
    public function __invoke(string $studentIdentificationCard, Request $request): JsonResponse
    {
        $this->validate($request, $this->getRequestRules());

        $CreateGradeCommand = new CreateGradeCommand(
            $studentIdentificationCard,
            $request->get('phase'),
            $request->get('grade'),
        );

        ($this->creator)($CreateGradeCommand);

        return response()->json([
            'message' => 'Grade registered successfully'
        ]);
    }

    /**
     * @return string[]
     */
    private function getRequestRules(): array
    {
        return [
            'phase' => 'required|int',
            'grade' => 'required|string',
        ];
    }
}
