<?php
namespace App\Infrastructure\Repository;

interface BaseRepositoryInterface
{
    /**
     * Find an entity by its unique ID.
     *
     * @param int $id
     * @return mixed|null
     */
    public function findById(int $id): ?object;

    /**
     * Retrieve all entities.
     *
     * @return array
     */
    public function findAll(): array;


    /**
     * Delete an entity by its ID.
     *
     * @param int $id
     * @return void
     */
    public function deleteById(int $id): void;
}
