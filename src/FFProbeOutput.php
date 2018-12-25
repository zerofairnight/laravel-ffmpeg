<?php

namespace Laravel\FFMpeg;

class FFProbeOutput
{
    /**
     * The raw data from the ffprobe.
     *
     * @var array
     */
    protected $data;

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
        return array_filter($this->data['streams'], function ($stream) {
            return $stream['codec_type'] === 'video';
        });
    }

    /**
     * Get the first video, null if the input is audio.
     *
     * @return array|null
     */
    public function video()
    {
        $videos = $this->videos();

        return count($videos) ? $videos[0] : null;
    }

    /**
     * Get the audios, empty if the input is video only or image.
     *
     * @return array
     */
    public function audios()
    {
        return array_filter($this->data['streams'], function ($stream) {
            return $stream['codec_type'] === 'audio';
        });
    }

    /**
     * Get the first audio, null if the input is video only or image.
     *
     * @return array|null
     */
    public function audio()
    {
        $audios = $this->audios();

        return count($audios) ? $audios[0] : null;
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
        return $this->get('video|audio.duration');
    }

    /**
     * Retrieves a value from the data array using "dot" notation.
     *
     * @return mixed
     */
    public function get($key)
    {
        if (is_null($key)) {
            return $this->data;
        }

        $data = $this->data;

        if (strpos($key, 'video.') === 0) {
            $data = $this->video();
            $key = substr($key, 6);
        }

        if (strpos($key, 'audio.') === 0) {
            $data = $this->audio();
            $key = substr($key, 6);
        }

        if (strpos($key, 'video|audio.') === 0) {
            $data = $this->video();
            $key = substr($key, 12);

            if (array_get($data, $key) === null) {
                $data = $this->audio();
            }

            return array_get($data, $key);
        }

        return array_get($data, $key);
    }
}
