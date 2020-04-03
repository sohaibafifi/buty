<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use App\Http\Requests\ApiRequest;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $resource
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ApiRequest $request, $resource, $id)
    {
        $model = "\\App\\Models\\" . Str::studly(Str::singular($resource));
        if (class_exists($model) && (new $model)->getTable() == $resource &&  $model::servable()) {
            $item = $model::findOrFail($id);
            $this->authorize('view', $item);
            return $item;
        } else {
            return abort(404);
        }
    }
}
