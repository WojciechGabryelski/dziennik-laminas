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
}