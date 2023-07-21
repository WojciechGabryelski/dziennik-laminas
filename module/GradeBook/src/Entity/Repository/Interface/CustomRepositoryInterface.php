<?php

namespace GradeBook\Entity\Repository\Interface;

interface CustomRepositoryInterface
{
    public function create(array $data): void;

    public function update(): void;

    public function delete(int $id): void;
}