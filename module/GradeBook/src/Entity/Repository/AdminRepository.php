<?php

namespace GradeBook\Entity\Repository;

use GradeBook\Entity\Admin;
use GradeBook\Entity\Repository\Interface\AdminRepositoryInterface;

class AdminRepository extends CustomRepository implements AdminRepositoryInterface
{
    public function getNewEntityInstance(): Admin
    {
        return new Admin();
    }
}