<?php

namespace BingNewsSearch\Structs;

class ImageThumbnail
{

    public function __construct(
        private string $contentUrl,
        private ?int   $width,
        private ?int   $height,

    )
    {
    }

    public function getContentUrl(): string
    {
        return $this->contentUrl;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }


}
