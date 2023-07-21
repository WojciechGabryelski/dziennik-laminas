<?php

namespace GradeBook\Entity\Repository\Interface;

use Doctrine\Common\Collections\Collection;

interface StudentRepositoryInterface extends CustomRepositoryInterface
{
    public function fetchCourseGrades(int $courseId): Collection;
}