<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityLogResource;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Tag(
 *     name="Activity Logs",
 *     description="API Endpoints for activity logging"
 * )
 */
class ActivityLogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/activity-logs",
     *     summary="Get activity logs",
     *     tags={"Activity Logs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Parameter(
     *         name="event_type",
     *         in="query",
     *         description="Filter by event type",
     *         required=false,
     *         @OA\Schema(type="string", enum={"created","updated","deleted"})
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="Filter by user ID",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="days",
     *         in="query",
     *         description="Get logs from last N days",
     *         required=false,
     *         @OA\Schema(type="integer", default=30)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Activity logs retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ActivityLogResource"))
     *         )
     *     )
     * )
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = ActivityLog::with('user')->orderBy('created_at', 'desc');

        // Filter by event type
        if ($request->has('event_type')) {
            $query->byEventType($request->event_type);
        }

        // Filter by user
        if ($request->has('user_id')) {
            $query->byUser($request->user_id);
        }

        // Filter by recent days
        $days = $request->get('days', 30);
        $query->recent($days);

        $perPage = $request->get('per_page', 15);
        $logs = $query->paginate($perPage);

        return ActivityLogResource::collection($logs);
    }

    /**
     * @OA\Get(
     *     path="/api/activity-logs/recent",
     *     summary="Get recent activity logs",
     *     tags={"Activity Logs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Number of recent logs to retrieve",
     *         required=false,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Recent activity logs retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ActivityLogResource"))
     *         )
     *     )
     * )
     */
    public function recent(Request $request): JsonResponse
    {
        $limit = $request->get('limit', 10);
        $logs = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => ActivityLogResource::collection($logs)
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/activity-logs/{id}",
     *     summary="Get a specific activity log",
     *     tags={"Activity Logs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Activity Log ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Activity log retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/ActivityLogResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Activity log not found"
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        $log = ActivityLog::with('user')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => new ActivityLogResource($log)
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/activity-logs/by-user/{userId}",
     *     summary="Get activity logs by user",
     *     tags={"Activity Logs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         description="User ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User activity logs retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ActivityLogResource"))
     *         )
     *     )
     * )
     */
    public function byUser(int $userId, Request $request): AnonymousResourceCollection
    {
        $perPage = $request->get('per_page', 15);
        $logs = ActivityLog::with('user')
            ->byUser($userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return ActivityLogResource::collection($logs);
    }

    /**
     * @OA\Get(
     *     path="/api/activity-logs/by-event/{eventType}",
     *     summary="Get activity logs by event type",
     *     tags={"Activity Logs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="eventType",
     *         in="path",
     *         description="Event type",
     *         required=true,
     *         @OA\Schema(type="string", enum={"created","updated","deleted"})
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event type activity logs retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ActivityLogResource"))
     *         )
     *     )
     * )
     */
    public function byEventType(string $eventType, Request $request): AnonymousResourceCollection
    {
        $perPage = $request->get('per_page', 15);
        $logs = ActivityLog::with('user')
            ->byEventType($eventType)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return ActivityLogResource::collection($logs);
    }
}
