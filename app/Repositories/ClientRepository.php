<?php


namespace App\Repositories;

use App\Models\Client;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * Class ClientRepository
 * @package App\Repositories
 */
class ClientRepository implements BaseRepositoryInterface
{
    /**
     * @var
     */
    private $client;
    /**
     * @var Client
     */
    private $model;
    /**
     * @var array
     */
    private array $relations = ['emails', 'phones'];
    /**
     * @var array
     */
    private array $searchable = ['name', 'last_name', 'phone', 'email'];

    /**
     * ClientRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Client();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $this->client = $this->model::create($request->all());
        $this->insertPhones($request->get('phones', null));
        $this->insertEmails($request->get('emails', null));
        return $this->client;
    }

    /**
     * @param $phones
     */
    public function insertPhones($phones) {
        try {
            if ($phones) {
                $insertValues = array_map(fn($phone) => compact('phone'), $phones);
                $this->client->phones()->delete();
                $this->client->phones()->createMany($insertValues);
            }
        } catch (Exception $exception) {
            Log::debug("Phones insert error: {$exception->getMessage()}");
        }
    }

    /**
     * @param $emails
     */
    public function insertEmails($emails) {
        try {
            if ($emails) {
                $insertValues = array_map(fn($email) => compact('email'), $emails);
                $this->client->emails()->delete();
                $this->client->emails()->createMany($insertValues);
            }
        } catch (Exception $exception) {
            Log::debug("Emails insert error: {$exception->getMessage()}");
        }
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find($id)
    {
        return $this->model::with($this->relations)->find($id);
    }

    /**
     * @param $perPage
     * @param null $searchField
     * @param null $searchValue
     * @return LengthAwarePaginator
     */
    public function all($perPage, $searchField = null, $searchValue = null) {
        $result = $this->model::with($this->relations);
        if($searchField) {
            $result = $this->search($result, $searchField, $searchValue);
        }
        return $result->paginate($perPage);
    }

    /**
     * @param $result
     * @param $field
     * @param $value
     * @return mixed
     */
    public function search($result, $field, $value) {
        if(in_array($field, $this->searchable)) {
            if(in_array($field, ['phone', 'email'])) {
                $relation = $field == 'phone' ? 'phones' : 'emails';
                $result = $result->whereHas($relation, fn ($q) => $q->where($field, 'LIKE', "%$value%"));
            } else {
                $result = $result->where($field, 'LIKE', "%$value%");
            }
        }
        return $result;
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    public function update($request, $id)
    {
        if ($client = $this->model::find($id)) {
            $client->update($request->all());
            $this->insertPhones($request->get('phones', null));
            $this->insertEmails($request->get('emails', null));
            return true;
        }
        return false;
    }
}