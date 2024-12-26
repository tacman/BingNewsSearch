<?php

namespace BingNewsSearch\Structs;

use BingNewsSearch\Enum;
use DateTime;

class NewsAnswer
{

    public function __construct(
        private ?string $_type=null,
        private ?string $readLink=null,
        private array $queryContext=[],
        private ?int $totalEstimatedMatches=null,
        private $sort=null,
        /** @var News[] */
        private array $value=[]
    )
    {
        $news = [];
        foreach ($this->value as $newsData) {
            try {
                $news[] = new News(...$newsData);
            } catch (\Exception $e) {
                dd($newsData, $e->getMessage());
            }
        }
        $this->value = $news;
    }


    public function getType(): ?string
    {
        return $this->_type;
    }

    public function getReadLink(): ?string
    {
        return $this->readLink;
    }

    public function getQueryContext(): array
    {
        return $this->queryContext;
    }

    public function getTotalEstimatedMatches(): ?int
    {
        return $this->totalEstimatedMatches;
    }

    public function getSort(): null
    {
        return $this->sort;
    }

    public function getValue(): array
    {
        return $this->value;
    }

}
