<?php

namespace Laravel\FFMpeg;

use Illuminate\Support\Traits\Macroable;

class FFMpeg
{
    use Macroable;

    /**
     * The ffmpeg driver instance.
     *
     * @var \Laravel\FFMpeg\FFMpegDriver
     */
    protected $driver;

    /**
     * Create a new ffmpeg instance.
     *
     * @param \Laravel\FFMpeg\FFMpegDriver $driver
     */
    function __construct(FFMpegDriver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Get the underlying ffmpeg driver.
     *
     * @return \Laravel\FFMpeg\FFMpegDriver
     */
    public function getDriver()
    {
        return $this->driver;
    }
}
