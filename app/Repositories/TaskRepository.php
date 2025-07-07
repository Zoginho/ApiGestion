<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    /**
     * Get tasks by project.
     */
    public function getByProject(int $projectId): Collection
    {
        return $this->model->where('project_id', $projectId)->get();
    }

    /**
     * Get tasks assigned to user.
     */
    public function getAssignedToUser(int $userId): Collection
    {
        return $this->model->where('assigned_to', $userId)->get();
    }

    /**
     * Get pending tasks.
     */
    public function getPending(): Collection
    {
        return $this->model->pending()->get();
    }

    /**
     * Get high priority tasks.
     */
    public function getHighPriority(): Collection
    {
        return $this->model->highPriority()->get();
    }

    /**
     * Get tasks by status.
     */
    public function getByStatus(string $status): Collection
    {
        return $this->model->where('status', $status)->get();
    }

    /**
     * Get tasks with relationships.
     */
    public function getWithRelations(array $relations = ['project', 'assignedUser', 'creator']): LengthAwarePaginator
    {
        return $this->model->with($relations)->paginate();
    }

    /**
     * Search tasks by title.
     */
    public function searchByTitle(string $title): Collection
    {
        return $this->model->where('title', 'like', "%{$title}%")->get();
    }
}
