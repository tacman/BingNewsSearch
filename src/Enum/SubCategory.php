<?php
namespace BingNewsSearch\Enum;

use InvalidArgumentException;

class SubCategory extends Enum implements IMarketCategory
{
    public const ENTERTAINMENT_MOVIEANDTV = 'Entertainment_MovieAndTV';
    public const ENTERTAINMENT_MUSIC = 'Entertainment_Music';
    public const TECHNOLOGY = 'Technology';
    public const SCIENCE = 'Science';
    public const SPORTS_GOLF = 'Sports_Golf';
    public const SPORTS_MLB = 'Sports_MLB';
    public const SPORTS_NBA = 'Sports_NBA';
    public const SPORTS_NFL = 'Sports_NFL';
    public const SPORTS_NHL = 'Sports_NHL';
    public const SPORTS_SOCCER = 'Sports_Soccer';
    public const SPORTS_TENNIS = 'Sports_Tennis';
    public const SPORTS_CFB = 'Sports_CFB';
    public const SPORTS_CBB = 'Sports_CBB';
    public const US_NORTHEAST = 'US_Northeast';
    public const US_SOUTH = 'US_South';
    public const US_MIDWEST = 'US_Midwest';
    public const US_WEST = 'US_West';

    public function parent(): Category
    {
        return match ($this->value) {
            self::ENTERTAINMENT_MOVIEANDTV, self::ENTERTAINMENT_MUSIC => Category::ENTERTAINMENT(),
            self::TECHNOLOGY, self::SCIENCE => Category::SCIENCEANDTECHNOLOGY(),
            self::SPORTS_GOLF, self::SPORTS_MLB, self::SPORTS_NBA, self::SPORTS_NFL, self::SPORTS_NHL, self::SPORTS_SOCCER, self::SPORTS_TENNIS, self::SPORTS_CFB, self::SPORTS_CBB => Category::SPORTS(),
            self::US_NORTHEAST, self::US_SOUTH, self::US_MIDWEST, self::US_WEST => Category::US(),
            default => throw new InvalidArgumentException("Invalid subcategory market. Check BingNewsSearch\Enum\SubCategory constants options."),
        };
    }
}