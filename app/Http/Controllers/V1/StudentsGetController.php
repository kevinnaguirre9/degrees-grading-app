<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class StudentsGetController
 *
 * @package App\Http\Controllers\V1
 */
final class StudentsGetController extends Controller
{
    /**
     * @param string $id
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(string $id, Request $request): JsonResponse
    {
        return response()
            ->json(['message' => 'Hello there!']);
    }
}
