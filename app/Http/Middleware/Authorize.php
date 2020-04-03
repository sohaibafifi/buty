<?php

namespace App\Http\Middleware;

use App\Http\Requests\ApiRequest;

class Authorize
{
    private $apiRequest;
    public function __construct(ApiRequest $request)
    {
        $this->apiRequest = $request;
    }

    public function handle($request, $next)
    {
        if (!$this->apiRequest->resource()::authorizedToViewAny($this))
            abort(403);
        return $next($request);
    }
}
