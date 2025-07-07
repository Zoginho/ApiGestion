<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\ProjectRepository;
use App\Http\Requests\ProjectRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ProjectService
{
    protected ProjectRepository $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all projects with pagination.
     */
    public function getAllProjects(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->getWithRelations(['creator', 'tasks'], $perPage);
    }

    /**
     * Get project by ID.
     */
    public function getProject(int $id): Project
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * Create a new project.
     */
    public function createProject(ProjectRequest $request): Project
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();

        return $this->repository->create($data);
    }

    /**
     * Update a project.
     */
    public function updateProject(int $id, ProjectRequest $request): bool
    {
        $data = $request->validated();
        return $this->repository->update($id, $data);
    }

    /**
     * Delete a project.
     */
    public function deleteProject(int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * Get active projects.
     */
    public function getActiveProjects(): Collection
    {
        return $this->repository->getActive();
    }

    /**
     * Get completed projects.
     */
    public function getCompletedProjects(): Collection
    {
        return $this->repository->getCompleted();
    }

    /**
     * Get projects by status.
     */
    public function getProjectsByStatus(string $status): Collection
    {
        return $this->repository->getByStatus($status);
    }

    /**
     * Search projects by name.
     */
    public function searchProjects(string $name): Collection
    {
        return $this->repository->searchByName($name);
    }

    /**
     * Get projects with tasks count.
     */
    public function getProjectsWithTasksCount(): LengthAwarePaginator
    {
        return $this->repository->getWithTasksCount();
    }
}
