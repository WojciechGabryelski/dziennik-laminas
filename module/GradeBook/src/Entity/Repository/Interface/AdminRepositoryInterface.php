<?php

namespace GradeBook\Entity\Repository\Interface;

use GradeBook\Entity\Admin;

interface AdminRepositoryInterface
{
    public function create(array $data): void;
    public function update(Admin $admin, array $data): void;
    public function delete(int $id): void;
}