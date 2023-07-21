<?php

namespace GradeBook\Entity\Repository\Interface;

use Doctrine\Common\Collections\Collection;
use GradeBook\Entity\Teacher;

interface TeacherRepositoryInterface
{
    public function create(array $data): void;
    public function update(Teacher $teacher, array $data): void;
    public function delete(int $id): void;
    public function fetchCourses(): Collection;
}