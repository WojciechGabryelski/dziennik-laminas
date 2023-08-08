<?php

namespace GradeBook\Entity\Repository;

use GradeBook\Entity\Grade;
use GradeBook\Entity\Repository\Interface\GradeRepositoryInterface;

class GradeRepository extends CustomRepository implements GradeRepositoryInterface
{

    public function getNewEntityInstance(): Grade
    {
        return new Grade();
    }

    public function getCoursesAndStudents(int $teacherId): array|float|int|string
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('c', 'sc', 's')
            ->from('GradeBook\Entity\Course', 'c', 'c.id')
            //->join('c.teacher', 't', 'with', 't.id = :teacherId')
            ->leftJoin('c.studentsCourse', 'sc')
            ->join('sc.student', 's')
            ->orderBy('s.lastName, s.firstName')
            ->getQuery()
            //->setParameter('teacherId', $teacherId)
            ->getArrayResult();
    }

    public function findStudentCourse($id) {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('sc')
            ->from('GradeBook\Entity\StudentCourse', 'sc')
            ->where('sc.id = :id')
            ->getQuery()
            ->setParameter('id', $id)
            ->getResult()[0];
    }
}