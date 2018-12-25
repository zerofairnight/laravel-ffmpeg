<?php

namespace Laravel\FFMpeg\Tests;

use Laravel\FFMpeg\FFProbe;
use Laravel\FFMpeg\FFProbeDriver;
use Laravel\FFMpeg\FFMpeg;
use Laravel\FFMpeg\FFMpegDriver;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * The cached ffmpeg instance.
     *
     * @var \Laravel\FFMpeg\FFMpeg
     */
    protected $ffmpeg;

    /**
     * Get the ffmpeg instance.
     *
     * @return \Laravel\FFMpeg\FFMpeg
     */
    public function ffmpeg()
    {
        if (is_null($this->ffmpeg)) {
            $this->ffmpeg = new FFMpeg(new FFMpegDriver('ffmpeg'));
        }

        return $this->ffmpeg;
    }

    /**
     * The cached ffprobe instance.
     *
     * @var \Laravel\FFMpeg\FFProbe
     */
    protected $ffprobe;

    /**
     * Get the ffprobe instance.
     *
     * @return \Laravel\FFMpeg\FFProbe
     */
    public function ffprobe()
    {
        if (is_null($this->ffprobe)) {
            $this->ffprobe = new FFProbe(new FFProbeDriver('ffprobe'));
        }

        return $this->ffprobe;
    }
}
