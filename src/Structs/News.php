<?php

namespace BingNewsSearch\Structs;

use BingNewsSearch\Enum;
use DateTime;

class News
{

    public function __construct(
        private string               $name,
        private null|DateTime|string $datePublished,
        private string               $description,
        private string               $url,

        private array                $about = [],
        private array                $provider = [],
        private array                $video = [],
        private array                $mentions = [],
        private null|Image|array     $image = null,
        private ?string              $category = null,

    )
    {
        if (is_string($this->datePublished)) {
            $this->datePublished = new DateTime($this->datePublished);
        }
        if (is_array($this->image)) {
            $this->image = new Image(...$this->image);
        }
    }

    public function getMentions(): array
    {
        return $this->mentions;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getImage(): array|Image|null
    {
        return $this->image;
    }

    public function getDatePublished(): DateTime|string
    {
        return $this->datePublished;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getId(): string
    {
        return hash('xxh3', $this->getUrl());

    }


}
