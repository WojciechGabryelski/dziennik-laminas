<?php

namespace GradeBook\Entity\Repository;

use Doctrine\Common\Collections\Collection;
use GradeBook\Entity\Repository\Interface\TeacherRepositoryInterface;
use GradeBook\Entity\Teacher;

class TeacherRepository extends CustomRepository implements TeacherRepositoryInterface
{
    public function fetchCourses(): Collection
    {
        $dql = "SELECT c FROM courses c JOIN teachers t";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }

    public function getNewEntityInstance(): Teacher
    {
        return new Teacher();
    }
}