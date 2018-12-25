<?php

namespace Laravel\FFMpeg\Tests\Unit;

use Laravel\FFMpeg\Tests\TestCase;

class FFMpegTest extends TestCase
{
    public function testCase()
    {
        $this->assertTrue($this->ffmpeg() !== null);
    }
}
