<?php

namespace GradeBook\Entity\Repository\Interface;

use Doctrine\Common\Collections\Collection;
use GradeBook\Entity\Student;

interface StudentRepositoryInterface
{
    public function create(array $data): void;
    public function update(Student $student, array $data): void;
    public function delete(int $id): void;
    public function fetchCourseGrades(int $courseId): Collection;
}