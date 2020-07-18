<?php

namespace App\Http\Controllers\Api;


use App\Models\LogOperation;
use Illuminate\Http\Response;

class LogApiController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *      path="/api/logs",
     *      operationId="getLogOpertions",
     *      tags={"Logs"},
     *      summary="Logs opertaion list and search",
     *      security={ {"bearerAuth": {} } },
     *      @OA\Parameter(
     *          name="per_page",
     *          description="Items per page",
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="operation",
     *          description="operation in list:create, update, delete",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="user_id",
     *          description="User id",
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response=200,description="Successful operation"),
     *     @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @return Response
     */
    public function index()
    {
        return LogOperation::orderBy('id', 'desc')->paginate($this->perPageInit);
    }
}
