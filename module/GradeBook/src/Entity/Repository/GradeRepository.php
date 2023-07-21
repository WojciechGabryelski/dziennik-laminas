<?php

namespace GradeBook\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use GradeBook\Entity\Grade;
use GradeBook\Entity\Repository\Interface\GradeRepositoryInterface;

class GradeRepository extends EntityRepository implements GradeRepositoryInterface
{
    public function create(array $data): void
    {
        $grade = new Grade();
        $grade->exchangeArray($data);
        $this->getEntityManager()->persist($grade);
        $this->getEntityManager()->flush();
    }

    public function update(Grade $grade, array $data): void
    {
        $grade->exchangeArray($data);
        $this->getEntityManager()->flush();
    }

    public function delete(int $id): void
    {
        $grade = $this->find($id);
        if ($grade != null) {
            $this->getEntityManager()->remove($grade);
            $this->getEntityManager()->flush();
        }
    }
}