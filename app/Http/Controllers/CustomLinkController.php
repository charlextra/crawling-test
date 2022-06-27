<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomLinkRequest;
use App\Services\CrawlingService;
use App\Services\CustomLinkService;
use App\Enums\Action;
use App\Models\Crawler;
use App\Traits\Controllers\WithMessage;
use Illuminate\Http\Request;

class CustomLinkController extends Controller {

    use WithMessage;

    private $CrawlingService;
    private $CustomLinkService;

    public function __construct( CrawlingService $CrawlingService, CustomLinkService $CustomLinkService)
    {

        $this->CrawlingService = $CrawlingService;
        $this->CustomLinkService = $CustomLinkService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function crawls(Request $request)
    {
        $crawlers = $request->has('url') ? Crawler::getCrawlsByUrl($request->url) : Crawler::getCrawls();
        return view('crawls')->with('crawlers', $crawlers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(StoreCustomLinkRequest $request)
    {
        $attributes = $request->validated();
        foreach($attributes['url_destination'] as $destination) {
            $this->CrawlingService->fetchContent($destination);
        }
        $this->CustomLinkService->store($attributes);
        return $this->backWithSuccess(Action::TYPE_CREATED);
    }

}
