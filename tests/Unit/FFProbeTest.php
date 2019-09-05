<?php

namespace Laravel\FFMpeg\Tests\Unit;

use Laravel\FFMpeg\Tests\TestCase;

class FFProbeTest extends TestCase
{
    /**
     * Get the file info.
     *
     * @param string $file
     *
     * @return \Laravel\FFMpeg\FFProbeOutput
     */
    protected function info($file)
    {
        return $this->ffprobe()->info($this->fixture($file));
    }

    public function test_webm()
    {
        $info = $this->info('640x360_32s.webm');

        $this->assertSame(640, $info->width());
        $this->assertSame(360, $info->height());
        $this->assertSame('32.480000', $info->duration());
    }

    public function test_mp4()
    {
        $info = $this->info('1280x720_5s.mp4');

        $this->assertSame(1280, $info->width());
        $this->assertSame(720, $info->height());
        $this->assertSame('5.280000', $info->duration());
    }

    public function test_flv()
    {
        $info = $this->info('1280x720_5s.flv');

        $this->assertSame(1280, $info->width());
        $this->assertSame(720, $info->height());
        $this->assertSame('5.160000', $info->duration());
    }

    public function test_mkv()
    {
        $info = $this->info('1280x720_3s.mkv');

        $this->assertSame(1280, $info->width());
        $this->assertSame(720, $info->height());
        $this->assertSame('3.600000', $info->duration());
    }

    public function test_wrong()
    {
        try {
            $this->info('WrongFile.mp4');
        } catch (\Exception $e) {
            $this->assertInstanceOf(\RuntimeException::class, $e);
        }
    }

    public function test_gif()
    {
        $info = $this->info('1.gif');

        $this->assertSame(256, $info->width());
        $this->assertSame(256, $info->height());
        $this->assertSame('2.000000', $info->duration());
    }

    public function test_jpg()
    {
        $info = $this->info('1.jpg');

        $this->assertSame(550, $info->width());
        $this->assertSame(368, $info->height());
    }

    public function test_png()
    {
        $info = $this->info('1.png');

        $this->assertSame(550, $info->width());
        $this->assertSame(368, $info->height());
        $this->assertSame(null, $info->duration());
    }

    public function test_webp()
    {
        $info = $this->info('1.webp');

        $this->assertSame(550, $info->width());
        $this->assertSame(368, $info->height());
        $this->assertSame(null, $info->duration());
    }
}
