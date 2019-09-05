<?php

namespace Laravel\FFMpeg;

use Illuminate\Support\Arr;

class FFProbeOutput
{
    /**
     * The raw data from the ffprobe.
     *
     * @var array
     */
    protected $data;

    /**
     * The videos stream data.
     *
     * @var array
     */
    protected $videos;

    /**
     * The audios stream data.
     *
     * @var array
     */
    protected $audios;

    /**
     * Create a new ffprobe output instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the videos, empty if the input is audio.
     *
     * @return array
     */
    public function videos()
    {
        if ($this->videos === null) {
            $this->videos = \array_values(\array_filter($this->data['streams'], function ($stream) {
                return $stream['codec_type'] === 'video';
            }));
        }

        return $this->videos;
    }

    /**
     * Get the first video, null if the input is audio.
     *
     * @return array|null
     */
    public function video()
    {
        $videos = $this->videos();

        return $videos[0] ?? null;
    }

    /**
     * Get the audios, empty if the input is video only or image.
     *
     * @return array
     */
    public function audios()
    {
        if ($this->audios === null) {
            $this->audios = \array_values(\array_filter($this->data['streams'], function ($stream) {
                return $stream['codec_type'] === 'audio';
            }));
        }

        return $this->audios;
    }

    /**
     * Get the first audio, null if the input is video only or image.
     *
     * @return array|null
     */
    public function audio()
    {
        $audios = $this->audios();

        return $audios[0] ?? null;
    }

    /**
     * Get the with and height of the input file.
     *
     * @return array
     */
    public function dimensions()
    {
        return [
            $this->width(),
            $this->height(),
        ];
    }

    /**
     * Get the with of the input file, null if the input is audio.
     *
     * @return int|null
     */
    public function width()
    {
        return $this->get('video.width');
    }

    /**
     * Get the height of the input file, null if the input is audio.
     *
     * @return int|null
     */
    public function height()
    {
        return $this->get('video.height');
    }

    /**
     * Get the duration in seconds of the input file, null if the input is image.
     *
     * @return string|null
     */
    public function duration()
    {
        return $this->get('video|audio.duration') ?: $this->get('format.duration');
    }

    /**
     * Retrieves a value from the data array using "dot" notation.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return array
     */
    public function get($key, $default = null)
    {
        if ($key === null) {
            return $this->data;
        }

        $data = $this->data;

        if (\strpos($key, 'video.') === 0) {
            $data = $this->video();
            $key = substr($key, 6);
        }

        if (\strpos($key, 'audio.') === 0) {
            $data = $this->audio();
            $key = substr($key, 6);
        }

        if (\strpos($key, 'video|audio.') === 0) {
            $data = $this->video();
            $key = substr($key, 12);

            if (Arr::get($data, $key, $default) === null) {
                $data = $this->audio();
            }

            return Arr::get($data, $key, $default);
        }

        return Arr::get($data, $key, $default);
    }
}
