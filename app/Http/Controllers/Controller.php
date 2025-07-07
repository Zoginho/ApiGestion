<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Project Management API",
 *     description="API RESTful para sistema de gestión de proyectos",
 *     @OA\Contact(
 *         email="admin@example.com",
 *         name="API Support"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="sanctum"
 * )
 *
 * @OA\Schema(
 *     schema="UserResource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
 *     @OA\Property(property="role", type="string", enum={"admin","project_manager","developer"}, example="developer"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="ProjectResource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Project Alpha"),
 *     @OA\Property(property="description", type="string", example="A new project description"),
 *     @OA\Property(property="start_date", type="string", format="date", example="2024-01-01"),
 *     @OA\Property(property="end_date", type="string", format="date", example="2024-12-31"),
 *     @OA\Property(property="status", type="string", enum={"active","completed","on_hold","cancelled"}, example="active"),
 *     @OA\Property(property="created_by", type="integer", example=1),
 *     @OA\Property(property="creator", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="tasks_count", type="integer", example=5),
 *     @OA\Property(property="tasks", type="array", @OA\Items(ref="#/components/schemas/TaskResource")),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="TaskResource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Implement login feature"),
 *     @OA\Property(property="description", type="string", example="Create user authentication system"),
 *     @OA\Property(property="priority", type="string", enum={"low","medium","high","urgent"}, example="medium"),
 *     @OA\Property(property="status", type="string", enum={"pending","in_progress","completed","cancelled"}, example="pending"),
 *     @OA\Property(property="due_date", type="string", format="date", example="2024-12-31"),
 *     @OA\Property(property="project_id", type="integer", example=1),
 *     @OA\Property(property="project", ref="#/components/schemas/ProjectResource"),
 *     @OA\Property(property="assigned_to", type="integer", example=2),
 *     @OA\Property(property="assigned_user", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="created_by", type="integer", example=1),
 *     @OA\Property(property="creator", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *     schema="ActivityLogResource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="event_type", type="string", example="created"),
 *     @OA\Property(property="loggable_type", type="string", example="App\\Models\\Project"),
 *     @OA\Property(property="loggable_id", type="integer", example=1),
 *     @OA\Property(property="description", type="string", example="Created Project: Project Alpha"),
 *     @OA\Property(property="old_values", type="object", nullable=true),
 *     @OA\Property(property="new_values", type="object", nullable=true),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="user", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="ip_address", type="string", example="127.0.0.1"),
 *     @OA\Property(property="user_agent", type="string", example="Mozilla/5.0..."),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
