<?php

namespace GradeBook\Entity\Repository;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use GradeBook\Entity\Repository\Factory\StudentRepositoryFactory;
use GradeBook\Entity\Repository\Interface\StudentRepositoryInterface;
use GradeBook\Entity\Student;

class StudentRepository extends EntityRepository implements StudentRepositoryInterface
{
    public function fetchCourseGrades(int $courseId): Collection {
        $dql = "SELECT g FROM grades g JOIN courses c WHERE c.id = ?1 ORDER BY g.date";
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $courseId);
        return $query->getResult();
    }

    public function create(array $data): void
    {
        $student = new Student();
        $student->exchangeArray($data);
        $this->getEntityManager()->persist($student);
        $this->getEntityManager()->flush();
    }

    public function update(Student $student, array $data): void
    {
        $student->exchangeArray($data);
        $this->getEntityManager()->flush();
    }

    public function delete(int $id): void
    {
        $student = $this->find($id);
        if ($student != null) {
            $this->getEntityManager()->remove($student);
            $this->getEntityManager()->flush();
        }
    }
}