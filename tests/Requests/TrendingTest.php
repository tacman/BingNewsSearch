<?php
namespace BingNewsSearch;

require_once './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use BingNewsSearch\Client;
use BingNewsSearch\Enum;
class TrendingTest extends TestCase
{
    public function testGet(): void
    {
        $client = new Client('', '');
        $this->assertInstanceOf(
            \BingNewsSearch\Requests\Trending::class,
            $client->trending()
        );
        
        $this->assertInstanceOf(
            \BingNewsSearch\Requests\Trending\Get::class,
            $client->trending()->get(Enum\Language::PT_BR())
        );

        $this->assertEquals(
            $client->trending()->get(Enum\Language::PT_BR())->getLanguage(),
            Enum\Language::PT_BR()
        );

        $request = $client->trending()->get(Enum\Language::PT_BR());
        $this->assertInstanceOf(
            '\DateTime',
            $request->since(new \DateTime)->getSince()
        );
        $this->assertEquals(
            $request->sortBy(Enum\SortBy::DATE())->getSortBy(),
            Enum\SortBy::DATE()
        );
    }
}
