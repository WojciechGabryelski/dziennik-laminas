<?php

namespace GradeBook\Entity\Repository;

use GradeBook\Entity\Repository\Interface\StudentRepositoryInterface;
use GradeBook\Entity\Student;

class StudentRepository extends CustomRepository implements StudentRepositoryInterface
{
    public function fetchAllGrades(int $studentId) {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('c', 'sc', 'g')
            ->from('GradeBook\Entity\Course', 'c')
            ->join('c.studentsCourse', 'sc')
            ->join('sc.student', 's', 'WITH', 's.id = :studentId')
            ->leftJoin('sc.grades', 'g')
            ->orderBy('g.date')
            ->getQuery()
            ->setParameter('studentId', $studentId)
            ->getResult();
    }

    public function getNewEntityInstance(): Student
    {
        return new Student();
    }
}