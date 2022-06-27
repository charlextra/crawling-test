<?php

namespace App\Traits\Rules;

use Goutte\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

/**
 * Trait WithMessage
 * @package App\Traits\Rules
 */
trait HostStatus
{

    private function cleanedLink($url): string
    {
        $result = parse_url($url);
        return $result['scheme'] . "://www." . $result['host'];
    }

    private function getIp($url): string
    {
        return gethostbyname(parse_url($url, PHP_URL_HOST));
    }

    public function isAvalaibleHost($url): int
    {
        $ip_address = $this->getIp($url);
        $ch = curl_init($ip_address);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $health = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $health ? 1 : 0;
    }

    private function getDestinationUrls($url): array
    {
        $all_links = [];
        try {
            $client = new Client();
            $crawler = $client->request('GET', $url);
            $links_count = $crawler->filter('a')->count();

            if($links_count > 0){
                $links = $crawler->filter('a')->links();
                foreach ($links as $link) {
                    $all_links[] = $this->cleanedLink($link->getURI());
                }
                $all_links = array_unique($all_links);
            }
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            return ['ErrorException' => '.'];
        }
        return $all_links;
    }

    public function isLinkNotPresentOnHost($url_ajout, $ancre, $url_destination)
    {
        $pageLinks = $this->getDestinationUrls($url_destination);
        if(array_key_exists('ErrorException', $pageLinks)){
            return $pageLinks['ErrorException'];
        }
        return ! in_array($this->cleanedLink($url_ajout), $this->getDestinationUrls($url_destination));
    }
}
