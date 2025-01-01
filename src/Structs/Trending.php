<?php

namespace BingNewsSearch\Structs;

use BingNewsSearch\Enum;
use DateTime;

class Trending
{
    private readonly string $name;
    private readonly ?Image $image;
    private readonly string $webSearchUrl;
    private readonly bool $isBreakingNews;
    private ?array $query;
//    private readonly string $newsSearchUrl;
    private readonly string $description;

    public function __construct(array $data)
    {
        $this->name = $data['name'] ?? '';
        $this->webSearchUrl = $data['webSearchUrl'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->image = isset($data['image']) ? new Image($data['image']) : null;
        if (isset($data['query'])) foreach ($data['query'] as $_query) {
            $this->query[] = $_query;
        }
        $this->isBreakingNews = $data['isBreakingNews'] ?? false;
//        $this->newsSearchUrl = $data['newsSearchUrl'] ?? false;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function webSearchUrl(): string
    {
        return $this->webSearchUrl;
    }

    public function image(): ?Image
    {
        return $this->image;
    }

    public function query(): ?array
    {
        return $this->query;
    }

    public function isBreakingNews(): bool
    {
        return $this->isBreakingNews;
    }

//    public function newsSearchUrl(): string
//    {
//        return $this->newsSearchUrl;
//    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'image' => $this->image,
            'webSearchUrl' => $this->webSearchUrl,
            'isBreakingNews' => $this->isBreakingNews,
            'query' => $this->query,
//            'newsSearchUrl' => $this->newsSearchUrl,
        ];
    }
}
