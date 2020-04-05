<?php

namespace App\Http\Middleware;

use App\Http\Requests\ResourceRequest;

class Authorize
{
    private $resourceRequest;
    public function __construct(ResourceRequest $request)
    {
        $this->resourceRequest = $request;
    }

    public function handle($request, $next)
    {
        if (
            $this->resourceRequest->isRequested()
            && method_exists($this->resourceRequest->resource(), 'authorizable')
            && !$this->resourceRequest->resource()::authorizedToViewAny($this)
        )
            abort(403);
        return $next($request);
    }
}
