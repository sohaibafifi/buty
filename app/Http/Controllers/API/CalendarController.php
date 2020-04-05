<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\ResourceRequest;

class CalendarController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/users/{id}/calendar",
     *      operationId="userCal",
     *      tags={"User", "Calendar"},
     *      summary="Get user calendar",
     *      description="Returns user calendar",
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
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
     * Get user calendar
     */
    public function userCal(ResourceRequest $request, User $user)
    {
        $this->authorize('viewCalendar', $user);
        if (!$user->cal || !filter_var($user->cal, FILTER_VALIDATE_URL)) {
            return abort(404);
        }
        $response = Http::get($user->cal);
        return response()->streamDownload(
            function () use ($response) {
                echo $response->body();
            },
            $user->name . '.ics',
            [
                'Content-Type' => 'text/calendar'
            ]
        );
    }

    /**
     * @OA\Get(
     *      path="/api/groups/{id}/calendar",
     *      operationId="userCal",
     *      tags={"Group", "Calendar"},
     *      summary="Get Resource information",
     *      description="Returns group calendar",
     *      @OA\Parameter(
     *          name="id",
     *          description="group id",
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
     * Get group calendar
     */
    public function groupCal(ResourceRequest $request, Group $group)
    {
        $this->authorize('viewCalendar', $group);
        if (!$group->cal || !filter_var($group->cal, FILTER_VALIDATE_URL)) {
            return abort(404);
        }
        $response = Http::get($group->cal);
        return response()->streamDownload(
            function () use ($response) {
                echo $response->body();
            },
            $group->name . '.ics',
            [
                'Content-Type' => 'text/calendar'
            ]
        );
    }
}
