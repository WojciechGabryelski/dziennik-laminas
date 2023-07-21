<?php

namespace GradeBook\Entity\Repository\Interface;

use Doctrine\Common\Collections\Collection;

interface TeacherRepositoryInterface extends CustomRepositoryInterface
{
    public function fetchCourses(): Collection;
}