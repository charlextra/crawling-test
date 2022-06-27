<?php

namespace App\Services;
use App\Repositories\CustomLinkRepository;


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
        $this->save($i, $items);
    }
    private function save($i, $items){
        for ($j=0; $j < $i; $j++) {
            $this->customLinkRepository->store([
                'url_destination' => $items[$j]['url_destination'],
                'url_ajout' => $items[$j]['url_ajout'].'#'.$items[$j]['ancre'],
                'ancre' => $items[$j]['ancre'],
            ]);
        }
    }
}
