<?php

namespace GradeBook\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use GradeBook\Entity\Course;
use GradeBook\Entity\Repository\Interface\CourseRepositoryInterface;

class CourseRepository extends EntityRepository implements CourseRepositoryInterface
{

    public function create(array $data): void
    {
        $course = new Course();
        $course->exchangeArray($data);
        $this->getEntityManager()->persist($course);
        $this->getEntityManager()->flush();
    }

    public function update(Course $course, array $data): void
    {
        $course->exchangeArray($data);
        $this->getEntityManager()->flush();
    }

    public function delete(int $id): void
    {
        $course = $this->find($id);
        if ($course != null) {
            $this->getEntityManager()->remove($course);
            $this->getEntityManager()->flush();
        }
    }
}