<?php

namespace Laravel\FFMpeg\Facades;

use Illuminate\Support\Facades\Facade;

class FFMpeg extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ffmpeg';
    }
}
