<?php

namespace Laravel\FFMpeg\Tests\Unit;

use Laravel\FFMpeg\Tests\TestCase;

class FFProbeTest extends TestCase
{
    public function testCase()
    {
        $this->assertTrue($this->ffprobe() !== null);
    }
}
