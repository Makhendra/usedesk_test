<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    protected $perPage = 10;

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
     * @param Request $request
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError(Request $request, $code)
    {
        return $this->sendResponse(false, $request->get('message', 'Error'), $code);
    }

    public function sendCreated($model)
    {
        return $this->sendResponse(true, 'Success create', 201, $model);
    }

    public function sendSuccess($data)
    {
        return $this->sendResponse(true, $data, 200);
    }

    public function sendResponse($success, $message, $code, $data = [])
    {
        return response()->json(
            [
                'success' => $success,
                'message' => $message,
                'data' => $data,
            ],
            $code
        );
    }
}