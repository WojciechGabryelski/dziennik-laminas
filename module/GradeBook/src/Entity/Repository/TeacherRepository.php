<?php

namespace GradeBook\Entity\Repository;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use GradeBook\Entity\Repository\Interface\TeacherRepositoryInterface;
use GradeBook\Entity\Teacher;

class TeacherRepository extends EntityRepository implements TeacherRepositoryInterface
{
    public function fetchCourses(): Collection
    {
        $dql = "SELECT c FROM courses c JOIN teachers t";
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }

    public function create(array $data): void
    {
        $teacher = new Teacher();
        $teacher->exchangeArray($data);
        $this->getEntityManager()->persist($teacher);
        $this->getEntityManager()->flush();
    }

    public function update(Teacher $teacher, array $data): void
    {
        $teacher->exchangeArray($data);
        $this->getEntityManager()->flush();
    }

    public function delete(int $id): void
    {
        $teacher = $this->find($id);
        if ($teacher != null) {
            $this->getEntityManager()->remove($teacher);
            $this->getEntityManager()->flush();
        }
    }
}