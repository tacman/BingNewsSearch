<?php

namespace BingNewsSearch\Enum;

use InvalidArgumentException;

enum SubCategory: string # implements IMarketCategory
{
    case ENTERTAINMENT_MOVIEANDTV = 'Entertainment_MovieAndTV';
    case ENTERTAINMENT_MUSIC = 'Entertainment_Music';
    case TECHNOLOGY = 'Technology';
    case SCIENCE = 'Science';
    case SPORTS_GOLF = 'Sports_Golf';
    case SPORTS_MLB = 'Sports_MLB';
    case SPORTS_NBA = 'Sports_NBA';
    case SPORTS_NFL = 'Sports_NFL';
    case SPORTS_NHL = 'Sports_NHL';
    case SPORTS_SOCCER = 'Sports_Soccer';
    case SPORTS_TENNIS = 'Sports_Tennis';
    case SPORTS_CFB = 'Sports_CFB';
    case SPORTS_CBB = 'Sports_CBB';
    case US_NORTHEAST = 'US_Northeast';
    case US_SOUTH = 'US_South';
    case US_MIDWEST = 'US_Midwest';
    case US_WEST = 'US_West';

    public function parent(): Category
    {
        return match ($this->value) {
            self::ENTERTAINMENT_MOVIEANDTV, self::ENTERTAINMENT_MUSIC => Category::ENTERTAINMENT,
            self::TECHNOLOGY, self::SCIENCE => Category::SCIENCEANDTECHNOLOGY,
            self::SPORTS_GOLF, self::SPORTS_MLB, self::SPORTS_NBA, self::SPORTS_NFL, self::SPORTS_NHL, self::SPORTS_SOCCER, self::SPORTS_TENNIS, self::SPORTS_CFB, self::SPORTS_CBB => Category::SPORTS,
            self::US_NORTHEAST, self::US_SOUTH, self::US_MIDWEST, self::US_WEST => Category::US,
            default => throw new InvalidArgumentException("Invalid subcategory market. 
                Check BingNewsSearch\Enum\SubCategory constants options."),
        };
    }
}
