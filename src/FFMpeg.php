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
     * The php-ffmpeg instance.
     *
     * @var mixed
     */
    protected $ffmpeg;

    /**
     * Create a new ffmpeg instance.
     *
     * @param \Laravel\FFMpeg\FFMpegDriver $driver
     */
    function __construct(FFMpegDriver $driver, $ffmpeg)
    {
        $this->driver = $driver;
        $this->ffmpeg = $ffmpeg;
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

    /**
     * Opens a file in order to be processed.
     *
     * @param mixed $file
     * @return Audio|Video
     */
    public function open($file)
    {
        return $this->ffmpeg->open($file);
    }
}
