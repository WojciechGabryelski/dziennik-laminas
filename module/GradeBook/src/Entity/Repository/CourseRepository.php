<?php

namespace GradeBook\Entity\Repository;

use GradeBook\Entity\Course;
use GradeBook\Entity\Repository\Interface\CourseRepositoryInterface;

class CourseRepository extends CustomRepository implements CourseRepositoryInterface
{

    public function getNewEntityInstance(): Course
    {
        return new Course();
    }
}