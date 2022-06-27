<?php

namespace App\Services;
use App\Models\Crawler;
use App\Repositories\CustomLinkRepository;
use Illuminate\Http\Request;


/**
 * Class CustomLinkService.
 */
class CustomLinkService
{
    private $customLinkRepository;

    public function __construct(CustomLinkRepository $customLinkRepository)
    {
        $this->customLinkRepository = $customLinkRepository;
    }

    public function store(array $attributes)
    {
        $this->bulkInsert($attributes);
        return true;
    }


    private function bulkInsert($attributes)
    {
        foreach($attributes as $key => $elements) {
            $i = 0;
            foreach($elements as $element) {
                $items[$i][$key] = $element;
                $i++;
            }

        }

        for ($j=0; $j < $i; $j++) {
            $this->customLinkRepository->store([
                'url_destination' => $items[$j]['url_destination'],
                'url_ajout' => $items[$j]['url_ajout'],
                'ancre' => $items[$j]['ancre'],
            ]);
        }
    }

    public static function listCrawls(Request $request)
    {
        if($request->has('url')){
            $crawlers = Crawler::where('url','LIKE','%'.$request->input('url').'%')->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(10);
        }else {
            $crawlers = Crawler::orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(10);
        }
        return $crawlers;
    }
}
