<?php

namespace App\Observers;

use App\Models\ClientPhone;
use App\Models\LogOperation;

class ClientPhoneObserver
{
    private $user_id;
    private $source = 'ClientPhone';
    private $log = '{}';

    public function __construct()
    {
        $this->user_id = auth()->id();
    }

    /**
     * Handle the client phone "created" event.
     *
     * @param ClientPhone $clientPhone
     * @return void
     */
    public function created(ClientPhone $clientPhone)
    {
        LogOperation::create(
            [
                'user_id' => $this->user_id,
                'operation' => 'create',
                'source' => $this->source,
                'source_id' => $clientPhone->id,
                'log' => $clientPhone,
            ]
        );
    }

    /**
     * Handle the client phone "updated" event.
     *
     * @param ClientPhone $clientPhone
     * @return void
     */
    public function updated(ClientPhone $clientPhone)
    {
        LogOperation::create(
            [
                'user_id' => $this->user_id,
                'operation' => 'update',
                'source' => $this->source,
                'source_id' => $clientPhone->id,
                'log' => $clientPhone,
            ]
        );
    }

    /**
     * Handle the client phone "deleted" event.
     *
     * @param ClientPhone $clientPhone
     * @return void
     */
    public function deleted(ClientPhone $clientPhone)
    {
        LogOperation::create(
            [
                'user_id' => $this->user_id,
                'operation' => 'delete',
                'source' => $this->source,
                'source_id' => $clientPhone->id,
                'log' => $this->log,
            ]
        );
    }

    /**
     * Handle the client phone "restored" event.
     *
     * @param ClientPhone $clientPhone
     * @return void
     */
    public function restored(ClientPhone $clientPhone)
    {
        //
    }

    /**
     * Handle the client phone "force deleted" event.
     *
     * @param ClientPhone $clientPhone
     * @return void
     */
    public function forceDeleted(ClientPhone $clientPhone)
    {
        //
    }
}
