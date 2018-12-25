# Laravel FFMpeg

A package that for work with ffmpeg in Laravel 

## Usage

Using this library is super easy.

Using Facades:

``` php
use Laravel\FFMpeg\Facades\FFMpeg;

$video = FFMpeg::open($file);
```

Using dependency injection:

``` php
use Laravel\FFMpeg\FFMpeg;
public function store(FFMpeg $ffmpeg)
{
    $video = $ffmpeg->open($file);
}
```

After open a file you can use any methods of the PHP-FFMpeg library.
