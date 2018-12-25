<?php

namespace Laravel\FFMpeg\Console\Commands;

use Illuminate\Console\Command;
use Laravel\FFMpeg\FFMpegDriver;

class FFMpegVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ffmpeg:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the ffmpeg version';

    /**
     * The ffmpeg driver.
     *
     * @var \Laravel\FFMpeg\FFMpegDriver;
     */
    protected $driver;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FFMpegDriver $driver)
    {
        parent::__construct();

        $this->driver = $driver;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info($this->driver->run(['-version']));
    }
}
