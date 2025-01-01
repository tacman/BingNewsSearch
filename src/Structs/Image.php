<?php

namespace BingNewsSearch\Structs;

class Image
{

    public function __construct(
        private ImageThumbnail|array|null $thumbnail = null,
        private readonly ?string         $url = null,
        private readonly array           $providers = [],

    )
    {
        if (is_array($thumbnail)) {
            $this->thumbnail = new ImageThumbnail(...$thumbnail);
        }
    }

    public function getThumbnail(): ?ImageThumbnail
    {
        return $this->thumbnail;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getProviders(): array
    {
        return $this->providers;
    }

}
