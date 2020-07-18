<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ClientResourceJson;
use App\Models\Client;
use App\Repositories\ClientRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends ApiController
{
    private ClientRepository $repository;
    protected int $perPage;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
        $this->perPage = request('per_page', $this->perPageInit);
    }

    /**
     * Clients list
     *
     * @OA\Get(
     *      path="/api/clients",
     *      operationId="getClientList",
     *      tags={"Clients"},
     *      summary="Clients list and search",
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
     *          name="search_field",
     *          description="Search field",
     *          in="query",
     *          @OA\Schema(
     *              type="enum",
     *              enum={"name", "last_name", "phone", "email", "all"},
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="search",
     *          description="Search value",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Client")
     *              ),
     *             @OA\Property(
     *                  property="links",
     *                  ref="#/components/schemas/Links"
     *              ),
     *             @OA\Property(
     *                  property="meta",
     *                  ref="#/components/schemas/Meta"
     *             ),
     *        ),
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     * )
     *
     * @param Request $request
     * @return ClientResource
     */
    public function index(Request $request)
    {
//        return ClientResource::collection($this->repository->all(
//            $this->perPage, $request->get('search_field'), $request->get('search')
//        ));
        return new ClientResource(Client::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\POST(
     *     path="/api/clients",
     *     summary="Add client",
     *     tags={"Clients"},
     *     security={ {"bearerAuth": {} } },
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="400", description="Error in question"),
     *     @OA\Response(response="401", description="Authorisation Error"),
     *     @OA\Response(response="422", description="Validation error"),
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
     * @return JsonResponse
     */
    public function store(ClientRequest $request)
    {
        $client = $this->repository->create($request);
        return $this->sendCreated(new ClientResourceJson($this->repository->find($client->id)));
    }

    /**
     * Display the specified resource.
     *
     * @OA\GET(
     *     path="/api/clients/{client_id}",
     *     summary="Show client",
     *     tags={"Clients"},
     *     security={ {"bearerAuth": {} } },
     *     @OA\Parameter(
     *          name="client_id",
     *          description="client id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="400", description="Error in question"),
     *   ),
     *)
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        if ($client = $this->repository->find($id)) {
            return $this->sendSuccess(
                'Client shown successfully',
                new ClientResourceJson($client)
            );
        }
        return $this->notFound();
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\PUT(
     *   path="/api/clients/{client_id}",
     *   summary="Update client",
     *   tags={"Clients"},
     *   security={ {"bearerAuth": {} } },
     *   @OA\Parameter(
     *         name="client_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *   ),
     *   @OA\RequestBody(
     *        request="Client",
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(ref="#/components/schemas/Client")
     *       )
     *    ),
     * @OA\Response(response="200", description="Client updated",),
     * @OA\Response(response="400", description="Error in question"),
     * @OA\Response(response="401", description="Authorisation Error"),
     * )
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        if ($this->repository->update($request, $id)) {
            return $this->sendSuccess(
                'Успешно обновлен',
                new ClientResourceJson($this->repository->find($id))
            );
        }
        return $this->notFound();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\DELETE(
     *     path="/api/clients/{client_id}",
     *     summary="Delete client",
     *     tags={"Clients"},
     *     security={ {"bearerAuth": {} } },
     *     @OA\Parameter(
     *          name="client_id",
     *          description="client id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="401", description="Authorisation Error"),
     *   ),
     *)
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $client = $this->repository->find($id);
        if ($client) {
            $client->delete();
            return $this->sendSuccess('Client successfully deleted');
        }
        return $this->notFound();
    }
}
