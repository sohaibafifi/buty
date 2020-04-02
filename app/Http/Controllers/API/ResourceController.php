<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
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
    public function show($resource, $id)
    {
        $model = "\\App\\" . Str::studly(Str::singular($resource));
        $resource = "\\App\\Http\\Resources\\" . Str::studly(Str::singular($resource));
        if (class_exists($model) && class_exists($resource)) {
            return new $resource($model::find($id));
        } else {
            return abort(404);
        }
    }
}
