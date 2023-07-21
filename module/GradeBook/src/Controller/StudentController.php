<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\StudentRepository;
use GradeBook\Form\StudentForm;

class StudentController extends CustomController {

    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
        $this->entityName = 'student';
    }
    public function getNewFormInstance(): StudentForm
    {
        return new StudentForm();
    }
}