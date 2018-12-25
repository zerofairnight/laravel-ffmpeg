<?php

namespace Laravel\FFMpeg;

use Illuminate\Support\ServiceProvider;

class FFMpegServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any ffmpeg services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/ffmpeg.php' => $this->app->configPath('ffmpeg.php'),
            ], 'config');

            $this->commands([
                \Laravel\FFMpeg\Console\Commands\FFMpegVersion::class,
                \Laravel\FFMpeg\Console\Commands\FFProbeVersion::class,
            ]);
        }
    }

    /**
     * Register any ffmpeg services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FFMpegDriver::class, function ($app) {
            return new FFMpegDriver($app['config']['ffmpeg.ffmpeg.bin'] ?? 'ffmpeg');
        });

        $this->app->bind(FFProbeDriver::class, function ($app) {
            return new FFProbeDriver($app['config']['ffmpeg.ffprobe.bin'] ?? 'ffprobe');
        });

        $this->app->singleton('ffmpeg', function ($app) {
            return new FFMpeg($app->make(FFMpegDriver::class));
        });

        $this->app->singleton('ffprobe', function ($app) {
            return new FFProbe($app->make(FFProbeDriver::class));
        });

        // $this->app->alias('ffmpeg', FFMpeg::class);
        // $this->app->alias('ffprobe', FFProbe::class);
    }
}
