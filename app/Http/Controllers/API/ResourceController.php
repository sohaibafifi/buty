<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;

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
     *      tags={"Resources"},
     *      summary="Get Resource information",
     *      description="Returns resource",
     *      @OA\Parameter(
     *          name="resource",
     *          description="Resource name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *              enum={"departments", "formations"}
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
     *       @OA\Response(response=403, description="This action is unauthorized"),
     *       @OA\Response(response=404, description="Resource not Found"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * Get Resource information
     */
    public function show(ResourceRequest $request, $resource, $id)
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
            return method_exists($item, 'loads') ? $item->load($item->loads()) : $item;
        } else {
            return abort(404);
        }
    }
}
