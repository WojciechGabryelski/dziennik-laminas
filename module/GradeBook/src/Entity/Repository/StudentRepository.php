<?php

namespace GradeBook\Entity\Repository;

use Doctrine\Common\Collections\Collection;
use GradeBook\Entity\Repository\Interface\StudentRepositoryInterface;
use GradeBook\Entity\Student;

class StudentRepository extends CustomRepository implements StudentRepositoryInterface
{
    public function fetchCourseGrades(int $courseId): Collection {
        $dql = "SELECT g FROM grades g JOIN courses c WHERE c.id = ?1 ORDER BY g.date";
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $courseId);
        return $query->getResult();
    }

    public function getNewEntityInstance(): Student
    {
        return new Student();
    }
}