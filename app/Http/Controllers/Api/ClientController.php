<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ClientController extends ApiController
{
    private $model;
    protected $perPage;

    public function __construct(Client $model)
    {
        $this->model = $model;
        $this->perPage = request('per_page', null) ?: $this->perPage;
    }

    /**
     * Список клиентов
     *
     * @OA\Get(
     *      path="/api/clients",
     *      operationId="getClientList",
     *      tags={"Clients"},
     *      summary="Список клиентов",
     *      security={ {"bearerAuth": {} } },
     *      @OA\Parameter(
     *          name="per_page",
     *          description="Количество элементов на страницу",
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          description="Номер страницы",
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *          @OA\Property(
     *              property="success",
     *              type="bolean",
     *              example="true"
     *          ),
     *          @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Clients retrieved successfully"
     *          ),
     *          @OA\Property(
     *              property="data",
     *              type="object",
     *              @OA\Property(
     *                  property="current_page",
     *                  type="integer",
     *                  example=1
     *              ),
     *             @OA\Property(
     *                  property="to",
     *                  type="integer",
     *                  example=3
     *              ),
     *              @OA\Property(
     *                  property="from",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="total",
     *                  type="integer",
     *                  example=3
     *              ),
     *              @OA\Property(
     *                  property="per_page",
     *                  type="integer",
     *                  example=15
     *              ),
     *              @OA\Property(
     *                  property="last_page",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="first_page_url",
     *                  type="string",
     *                  example="http://localhost:8000/api/clients?page=1"
     *              ),
     *              @OA\Property(
     *                  property="next_page_url",
     *                  type="string",
     *                  example="null"
     *              ),
     *              @OA\Property(
     *                  property="last_page_url",
     *                  type="string",
     *                  example="http://localhost:8000/api/clients?page=1"
     *              ),
     *              @OA\Property(
     *                  property="prev_page_url",
     *                  type="integer",
     *                  example=1
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Client")
     *              )
     *          ),
     *        ),
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @return AnonymousResourceCollection|Response
     */
    public function index()
    {
        return new ClientResource(Client::with(['emails', 'phones'])->paginate($this->perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\POST(
     *     path="/api/clients",
     *     summary="Добавление клиента",
     *     tags={"Clients"},
     *     security={ {"bearerAuth": {} } },
     *     @OA\Response(response="200", description="Успех"),
     *     @OA\Response(response="400", description="Ошибка в запросе"),
     *     @OA\Response(response="401", description="Ошибка авторизации"),
     *     @OA\Response(response="422", description="Ошибка валидации"),
     *     @OA\RequestBody(
     *        request="client",
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(ref="#/components/schemas/Client")
     *       )
     *    )
     *   ),
     *)
     *
     * @param ClientRequest $request
     * @return Response
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->all());

        if($phones = $request->get('phones', null)) {
            $client->phones()->createMany($phones);
        }

        if($emails = $request->get('emails', null)) {
            $client->emails()->createMany($emails);
        }

        return $this->sendCreated($client->with(['emails', 'phones']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(ClientRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
