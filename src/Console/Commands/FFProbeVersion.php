<?php

namespace Laravel\FFMpeg\Console\Commands;

use Illuminate\Console\Command;
use Laravel\FFMpeg\FFProbeDriver;

class FFProbeVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ffprobe:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the ffprobe version';

    /**
     * The ffprobe driver.
     *
     * @var \Laravel\FFMpeg\FFProbeDriver;
     */
    protected $driver;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FFProbeDriver $driver)
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
