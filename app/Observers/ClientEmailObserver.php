<?php

namespace App\Observers;

use App\Models\ClientEmail;
use App\Models\LogOperation;

class ClientEmailObserver
{

    private $user_id;
    private $source = 'ClientEmail';
    private $log = '{}';

    public function __construct()
    {
        $this->user_id = auth()->id() ?: 1;
    }

    /**
     * Handle the client email "created" event.
     *
     * @param ClientEmail $clientEmail
     * @return void
     */
    public function created(ClientEmail $clientEmail)
    {
        LogOperation::create(
            [
                'user_id' => $this->user_id,
                'operation' => 'create',
                'source' => $this->source,
                'source_id' => $clientEmail->id,
                'log' => $clientEmail,
            ]
        );
    }

    /**
     * Handle the client email "updated" event.
     *
     * @param ClientEmail $clientEmail
     * @return void
     */
    public function updated(ClientEmail $clientEmail)
    {
        LogOperation::create(
            [
                'user_id' => $this->user_id,
                'operation' => 'update',
                'source' => $this->source,
                'source_id' => $clientEmail->id,
                'log' => $clientEmail,
            ]
        );
    }

    /**
     * Handle the client email "deleted" event.
     *
     * @param ClientEmail $clientEmail
     * @return void
     */
    public function deleted(ClientEmail $clientEmail)
    {
        LogOperation::create(
            [
                'user_id' => $this->user_id,
                'operation' => 'delete',
                'source' => $this->source,
                'source_id' => $clientEmail->id,
                'log' => $this->log,
            ]
        );
    }

    /**
     * Handle the client email "restored" event.
     *
     * @param ClientEmail $clientEmail
     * @return void
     */
    public function restored(ClientEmail $clientEmail)
    {
        //
    }

    /**
     * Handle the client email "force deleted" event.
     *
     * @param ClientEmail $clientEmail
     * @return void
     */
    public function forceDeleted(ClientEmail $clientEmail)
    {
        //
    }
}
