<?php

namespace GradeBook\Entity\Repository\Interface;

use GradeBook\Entity\Course;

interface CourseRepositoryInterface
{
    public function create(array $data): void;
    public function update(Course $course, array $data): void;
    public function delete(int $id): void;
}