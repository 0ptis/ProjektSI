<?php

/**
 * Task service interface.
 */

namespace App\Service;

use App\Dto\TaskListInputFiltersDto;
use App\Entity\Task;
use App\Entity\User;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface TaskServiceInterface.
 */
interface TaskServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int                     $page    Page number
     * @param User                    $author  Author
     * @param TaskListInputFiltersDto $filters Filters
     *
     * @return PaginationInterface Paginated list
     */
    public function getPaginatedList(int $page, User $author, TaskListInputFiltersDto $filters): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Task $task Task entity
     */
    public function save(Task $task): void;

    /**
     * Delete entity.
     *
     * @param Task $task Task entity
     */
    public function delete(Task $task): void;
}
