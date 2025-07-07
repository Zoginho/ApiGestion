<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Http\Requests\TaskRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    protected TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all tasks with pagination.
     */
    public function getAllTasks(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->getWithRelations(['project', 'assignedUser', 'creator'], $perPage);
    }

    /**
     * Get task by ID.
     */
    public function getTask(int $id): Task
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * Create a new task.
     */
    public function createTask(TaskRequest $request): Task
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        return $this->repository->create($data);
    }

    /**
     * Update a task.
     */
    public function updateTask(int $id, TaskRequest $request): bool
    {
        $data = $request->validated();
        return $this->repository->update($id, $data);
    }

    /**
     * Delete a task.
     */
    public function deleteTask(int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * Get tasks by project.
     */
    public function getTasksByProject(int $projectId): Collection
    {
        return $this->repository->getByProject($projectId);
    }

    /**
     * Get tasks assigned to user.
     */
    public function getTasksAssignedToUser(int $userId): Collection
    {
        return $this->repository->getAssignedToUser($userId);
    }

    /**
     * Get pending tasks.
     */
    public function getPendingTasks(): Collection
    {
        return $this->repository->getPending();
    }

    /**
     * Get high priority tasks.
     */
    public function getHighPriorityTasks(): Collection
    {
        return $this->repository->getHighPriority();
    }

    /**
     * Get tasks by status.
     */
    public function getTasksByStatus(string $status): Collection
    {
        return $this->repository->getByStatus($status);
    }

    /**
     * Search tasks by title.
     */
    public function searchTasks(string $title): Collection
    {
        return $this->repository->searchByTitle($title);
    }

    /**
     * Assign task to user.
     */
    public function assignTask(int $taskId, int $userId): bool
    {
        return $this->repository->update($taskId, ['assigned_to' => $userId]);
    }

    /**
     * Update task status.
     */
    public function updateTaskStatus(int $taskId, string $status): bool
    {
        return $this->repository->update($taskId, ['status' => $status]);
    }
}
