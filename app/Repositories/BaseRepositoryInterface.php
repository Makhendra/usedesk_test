<?php


namespace App\Repositories;


/**
 * Interface BaseRepositoryInterface
 * @package App\Repositories
 */
interface BaseRepositoryInterface
{
    /**
     * @param $perPage
     * @return mixed
     */
    public function all($perPage);

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id);
}