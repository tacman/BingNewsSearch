<?php
namespace BingNewsSearch\Enum;

enum SortBy:string
{
    case DATE  = 'Date';
    case RELEVANCE = 'Relevance';

    public function isDate(): bool
    {
        return $this->value === self::DATE;
    }
    
    public function isRelevance(): bool
    {
        return $this->value === self::DATE;
    }
}
