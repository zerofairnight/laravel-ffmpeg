<?php

namespace Laravel\FFMpeg\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Telegram.
 */
class FFProbe extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ffprobe';
    }
}
