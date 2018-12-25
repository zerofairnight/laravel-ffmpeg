<?php

return [

    'ffmpeg' => [
        'bin' => env('FFMPEG_BIN', 'ffmpeg'),
        'timeout' => 3600,
        'threads' => 12,
    ],

    'ffprobe' => [
        'bin' => env('FFPROBE_BIN', 'ffprobe'),
        'timeout' => 30,
    ],

];
