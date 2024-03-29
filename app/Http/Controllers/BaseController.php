<?php
/**
 * @OA\Info(
 *     title="User API",
 *     version="1.0.0",
 *     description="API for managing users",
 *     @OA\Contact(
 *         email="mohamadtalemsi@gmail.com"
 *     ),
 *     @OA\License(
 *         name="abdellah talemsi",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return JsonResponse
     */

    public function sendResponse($result, $message): JsonResponse
    {
        $response = [

            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return JsonResponse
     */

    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [

            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
