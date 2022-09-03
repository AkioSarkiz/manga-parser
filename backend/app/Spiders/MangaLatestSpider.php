<?php

declare(strict_types=1);

namespace App\Spiders;

use App\Spiders\Processors\MangaValidation;
use App\Spiders\Processors\SaveMangaProcessor;
use Generator;
use RoachPHP\Downloader\Middleware\RequestDeduplicationMiddleware;
use RoachPHP\Downloader\Middleware\UserAgentMiddleware;
use RoachPHP\Extensions\LoggerExtension;
use RoachPHP\Extensions\StatsCollectorExtension;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use Symfony\Component\DomCrawler\Crawler;

class MangaLatestSpider extends BasicSpider
{
    public array $startUrls = [
        'https://mangakakalot.com/manga_list?type=latest&category=all&state=all&page=1'
    ];

    public array $downloaderMiddleware = [
        RequestDeduplicationMiddleware::class,
        [UserAgentMiddleware::class, ['userAgent' => 'Mozilla/5.0 (compatible; RoachPHP/0.1.0)']],
    ];

    public array $spiderMiddleware = [
        //
    ];

    public array $itemProcessors = [
        MangaValidation::class,
        SaveMangaProcessor::class,
    ];

    public array $extensions = [
        LoggerExtension::class,
        StatsCollectorExtension::class,
    ];

    public int $concurrency = 4;

    public int $requestDelay = 3;

    /**
     * @param Response $response
     * @return Generator
     */
    public function parse(Response $response): Generator
    {
        $items = $response
            ->filter('.list-truyen-item-wrap')
            ->each(fn(Crawler $crawler) => $this->item([
                'raw_data' => $response->getBody(),
                'parsed_data' => [
                    'uri' => $uri = $crawler->filter('a:nth-child(1)')->first()->link()->getUri(),
                    'cover' => $crawler->filter('img')->attr('src'),
                    'title' => $crawler->filter('h3')->text(),
                    'description' => $crawler->filter('p')->text()
                ],
                'key' => $uri,
                'source' => 'mangakakalot.com',
            ]));

        foreach ($items as $item) {
            yield $item;
        }
    }
}
