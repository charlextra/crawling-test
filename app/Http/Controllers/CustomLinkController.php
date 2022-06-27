<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomLinkRequest;
use App\Services\CustomLinkService;
use App\Enums\Action;
use App\Traits\Controllers\WithMessage;

class CustomLinkController extends Controller {

    use WithMessage;

    private $CrawlingService;
    private $CustomLinkService;

    public function __construct(CustomLinkService $CustomLinkService)
    {
        $this->CustomLinkService = $CustomLinkService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCustomLinkRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(StoreCustomLinkRequest $request)
    {
        $attributes = $request->validated();
        $this->CustomLinkService->store($attributes);
        return $this->backWithSuccess(Action::TYPE_CREATED);
    }

}
