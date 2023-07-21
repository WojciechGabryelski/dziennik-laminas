<?php

namespace GradeBook\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use GradeBook\Entity\Admin;
use GradeBook\Entity\Repository\Interface\AdminRepositoryInterface;

class AdminRepository extends EntityRepository implements AdminRepositoryInterface
{
    public function create(array $data): void
    {
        $admin = new Admin();
        $admin->exchangeArray($data);
        $this->getEntityManager()->persist($admin);
        $this->getEntityManager()->flush();
    }

    public function update(Admin $admin, array $data): void
    {
        $admin->exchangeArray($data);
        $this->getEntityManager()->flush();
    }

    public function delete(int $id): void
    {
        $admin = $this->find($id);
        if ($admin != null) {
            $this->getEntityManager()->remove($admin);
            $this->getEntityManager()->flush();
        }
    }
}