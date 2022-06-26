<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Observers\CustomCrawlerObserver;
use Spatie\Crawler\CrawlProfiles\CrawlInternalUrls;
use Spatie\Crawler\Crawler;
use App\Http\Controllers\Controller;
use GuzzleHttp\RequestOptions;

/**
 * Class CrawlingService.
 */
class CrawlingService 
{    

    public function __construct()
    {

    }

    /**
     * Crawl the website content.
     * @return true
     */
    public function fetchContent(String $url){
        //# initiate crawler 
        Crawler::create([RequestOptions::ALLOW_REDIRECTS => true, RequestOptions::TIMEOUT => 30])
        ->acceptNofollowLinks()
        ->ignoreRobots()
        // ->setParseableMimeTypes(['text/html', 'text/plain'])
        ->setCrawlObserver(new CustomCrawlerObserver())
        ->setCrawlProfile(new CrawlInternalUrls($url))
        ->setMaximumResponseSize(1024 * 1024 * 2) // 2 MB maximum
        ->setTotalCrawlLimit(100) // limit defines the maximal count of URLs to crawl
        // ->setConcurrency(1) // all urls will be crawled one by one
        ->setDelayBetweenRequests(100)
        ->startCrawling($url);
        return true;
    }

}
