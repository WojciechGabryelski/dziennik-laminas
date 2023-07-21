<?php

namespace GradeBook\Entity\Repository\Interface;

use GradeBook\Entity\Grade;

interface GradeRepositoryInterface
{
    public function create(array $data): void;
    public function update(Grade $grade, array $data): void;
    public function delete(int $id): void;
}