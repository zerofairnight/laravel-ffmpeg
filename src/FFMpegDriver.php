<?php

namespace Laravel\FFMpeg;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class FFMpegDriver
{
    /**
     * The ffmpeg binary file location.
     *
     * @var string
     */
    protected $bin;

    /**
     * Create a new ffmpeg driver instance.
     *
     * @param string $bin The binary location
     */
    public function __construct($bin)
    {
        $this->bin = $bin;
    }

    /**
     * Runs the binary.
     *
     * @param array $command The command to run and its arguments listed as separate entries
     * @param callable $callback
     *
     * @return string
     */
    public function run(array $commands = [], callable $callback = null)
    {
        \array_unshift($commands, $this->bin);

        $process = new Process($commands);

        if ($callback) {
            $callback($process);
        }

        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }
}
