<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\LogOperation;

class ClientObserver
{
    private $user_id;
    private $source = 'Client';
    private $log = '{}';

    public function __construct()
    {
        $this->user_id = auth()->id();
    }

    /**
     * Handle the client "created" event.
     *
     * @param Client $client
     * @return void
     */
    public function created(Client $client)
    {
        LogOperation::create(
            [
                'user_id' => $this->user_id,
                'operation' => 'create',
                'source' => $this->source,
                'source_id' => $client->id,
                'log' => $client,
            ]
        );
    }

    /**
     * Handle the client "updated" event.
     *
     * @param Client $client
     * @return void
     */
    public function updated(Client $client)
    {
        LogOperation::create(
            [
                'user_id' => $this->user_id,
                'operation' => 'update',
                'source' => $this->source,
                'source_id' => $client->id,
                'log' => $client,
            ]
        );
    }

    /**
     * Handle the client "deleted" event.
     *
     * @param Client $client
     * @return void
     */
    public function deleted(Client $client)
    {
        LogOperation::create(
            [
                'user_id' => $this->user_id,
                'operation' => 'delete',
                'source' => $this->source,
                'source_id' => $client->id,
                'log' => $this->log,
            ]
        );
    }

    /**
     * Handle the client "restored" event.
     *
     * @param Client $client
     * @return void
     */
    public function restored(Client $client)
    {
        //
    }

    /**
     * Handle the client "force deleted" event.
     *
     * @param Client $client
     * @return void
     */
    public function forceDeleted(Client $client)
    {
        //
    }
}
