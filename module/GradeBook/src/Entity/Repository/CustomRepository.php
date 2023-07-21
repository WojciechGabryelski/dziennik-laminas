<?php

namespace GradeBook\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use GradeBook\Entity\Repository\Interface\CustomRepositoryInterface;

abstract class CustomRepository extends EntityRepository implements CustomRepositoryInterface
{
    public function create(array $data): void
    {
        $entity = $this->getNewEntityInstance();
        $entity->exchangeArray($data);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function update(): void
    {
        $this->getEntityManager()->flush();
    }

    public function delete(int $id): void
    {
        $entity = $this->find($id);
        if ($entity != null) {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
        }
    }

    abstract public function getNewEntityInstance();
}