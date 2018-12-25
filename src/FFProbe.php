<?php

namespace Laravel\FFMpeg;

use Illuminate\Support\Traits\Macroable;

class FFProbe
{
    use Macroable;

    /**
     * The ffprobe driver instance.
     *
     * @var \Laravel\FFMpeg\FFProbeDriver
     */
    protected $driver;

    /**
     * Create a new ffprobe instance.
     *
     * @param \Laravel\FFMpeg\FFProbeDriver $driver
     */
    function __construct(FFProbeDriver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Get the underlying ffprobe driver.
     *
     * @return \Laravel\FFMpeg\FFProbeDriver
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Undocumented function.
     *
     * @param string $file
     * @return void
     */
    public function info($file)
    {
        $output = $this->driver->run([
            '-v', 'quiet',
            '-show_error',
            '-show_format',
            '-show_streams',
            '-print_format', 'json=compact=1', // compact json
            '-i',
            (string) $file
        ]);

        return new FFProbeOutput(json_decode($output, true));
    }
}
