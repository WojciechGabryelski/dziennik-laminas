<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\GradeRepository;
use GradeBook\Form\GradeForm;

class GradeController extends CustomController
{
    public function __construct(GradeRepository $repository)
    {
        $this->repository = $repository;
        $this->entityName = 'grade';
    }
    public function getNewFormInstance(): GradeForm
    {
        return new GradeForm();
    }
}