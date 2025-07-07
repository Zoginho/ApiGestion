<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectRepository extends BaseRepository
{
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    /**
     * Get active projects.
     */
    public function getActive(): Collection
    {
        return $this->model->active()->get();
    }

    /**
     * Get completed projects.
     */
    public function getCompleted(): Collection
    {
        return $this->model->completed()->get();
    }

    /**
     * Get projects by status.
     */
    public function getByStatus(string $status): Collection
    {
        return $this->model->where('status', $status)->get();
    }

    /**
     * Get projects with tasks count.
     */
    public function getWithTasksCount(): LengthAwarePaginator
    {
        return $this->model->withCount('tasks')->paginate();
    }

    /**
     * Get projects with relationships.
     */
    public function getWithRelations(array $relations = ['creator', 'tasks']): LengthAwarePaginator
    {
        return $this->model->with($relations)->paginate();
    }

    /**
     * Search projects by name.
     */
    public function searchByName(string $name): Collection
    {
        return $this->model->where('name', 'like', "%{$name}%")->get();
    }
}
