<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use App\Http\Requests\ApiRequest;
use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Buty resource api",
 *      description="Buty Swagger OpenApi description",
 * )
 */
class ResourceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $resource
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/api/{resource}/{id}",
     *      operationId="show",
     *      tags={"Resource"},
     *      summary="Get Resource information",
     *      description="Returns resource",
     *      @OA\Parameter(
     *          name="resource",
     *          description="Resource name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="id",
     *          description="Resource id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Get Resource information
     */
    public function show(ApiRequest $request, $resource, $id)
    {
        $model = "\\App\\Models\\" . Str::studly(Str::singular($resource));
        if (
            class_exists($model)
            && (new $model)->getTable() == $resource
            && method_exists($model, 'servable')
            &&  $model::servable()
        ) {
            $item = $model::findOrFail($id);
            $this->authorize('view', $item);
            return $item;
        } else {
            return abort(404);
        }
    }
}
