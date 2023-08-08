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

    public function getTeachers(): array|float|int|string
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('t')
            ->from('GradeBook\Entity\Teacher', 't')
            ->getQuery()
            ->getArrayResult();
    }

    public function findTeacher($id) {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('t')
            ->from('GradeBook\Entity\Teacher', 't')
            ->where('t.id = :id')
            ->getQuery()
            ->setParameter('id', $id)
            ->getResult()[0];
    }
}