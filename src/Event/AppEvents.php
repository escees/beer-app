<?php

declare(strict_types=1);

namespace App\Event;

final class AppEvents
{
    /**
     * Is thrown when import data from ontario beer API was successful.
     *
     * @see DataImportSuccessEvent
     *
     * @var string
     */
    public const DATA_IMPORT_SUCCESSFUL = 'app.data.import.successful';
}