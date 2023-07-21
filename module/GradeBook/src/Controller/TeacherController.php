<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\TeacherRepository;
use GradeBook\Form\TeacherForm;

class TeacherController extends CustomController
{
    public function __construct(TeacherRepository $repository)
    {
        $this->repository = $repository;
        $this->entityName = 'teacher';
    }
    public function getNewFormInstance(): TeacherForm
    {
        return new TeacherForm();
    }
}