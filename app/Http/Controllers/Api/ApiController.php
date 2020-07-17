<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    protected int $perPageInit = 10;

    /**
     * @OA\Info(title="USEDESCK_TEST Api", version="1")
     * @OA\SecurityScheme(
     *     type="http",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="bearerAuth",
     *     name="Authorization",
     * )
     */

    /**
     * @return JsonResponse
     */
    public function sendUnauthorized()
    {
        return $this->sendResponse('Unauthorized', JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * @param $model
     * @return JsonResponse
     */
    public function sendCreated($model)
    {
        return $this->sendResponse('Success create', JsonResponse::HTTP_CREATED, $model);
    }

    /**
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    public function sendSuccess($message, $data = [])
    {
        return $this->sendResponse($message, JsonResponse::HTTP_OK, $data);
    }

    /**
     * @return JsonResponse
     */
    public function notFound() {
        return $this->sendResponse('Not found', JsonResponse::HTTP_NOT_FOUND, []);
    }

    /**
     * @param $message
     * @param $code
     * @param array $data
     * @return JsonResponse
     */
    public function sendResponse($message, $code, $data = [])
    {
        return response()->json(
            [
                'message' => $message,
                'data' => $data,
            ],
            $code
        );
    }

    public function getPerPage() {
        return self::perPage;
    }
}