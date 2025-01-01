<?php
namespace BingNewsSearch;

require_once './vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use BingNewsSearch\Client;
class SearchTest extends TestCase
{
    public function testGet(): void
    {
        $client = new Client('', '');
        $this->assertInstanceOf(
            \BingNewsSearch\Requests\Search::class,
            $client->search()
        );
        
        $this->assertInstanceOf(
            \BingNewsSearch\Requests\Search\Get::class,
            $client->search()->get('something cool')
        );

        $this->assertEquals(
            $client->search()->get('something cool')->getQ(),
            'something cool'
        );
    }
}
