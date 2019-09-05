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
     * The cached ffprobe instance.
     *
     * @var \Laravel\FFMpeg\FFProbe
     */
    protected $ffprobe;

    /**
     * Get the ffmpeg instance.
     *
     * @return \Laravel\FFMpeg\FFMpeg
     */
    public function ffmpeg()
    {
        if ($this->ffmpeg === null) {
            $this->ffmpeg = new FFMpeg(
                new FFMpegDriver($_ENV['FFMPEG_BIN']),
                \FFMpeg\FFMpeg::create([
                    'ffmpeg.binaries' => $_ENV['FFMPEG_BIN'],
                    'ffprobe.binaries' => $_ENV['FFPROBE_BIN'],
                ])
            );
        }

        return $this->ffmpeg;
    }

    /**
     * Get the ffprobe instance.
     *
     * @return \Laravel\FFMpeg\FFProbe
     */
    public function ffprobe()
    {
        if ($this->ffprobe === null) {
            $this->ffprobe = new FFProbe(
                new FFProbeDriver($_ENV['FFPROBE_BIN'])
            );
        }

        return $this->ffprobe;
    }

    /**
     * Get a fixture file path.
     *
     * @return string
     */
    public function fixture($file)
    {
        return __DIR__.DIRECTORY_SEPARATOR.'fixtures'.DIRECTORY_SEPARATOR.$file;
    }
}
