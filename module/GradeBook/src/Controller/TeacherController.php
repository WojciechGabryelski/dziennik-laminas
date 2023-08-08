<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\TeacherRepository;
use GradeBook\Form\TeacherForm;

class TeacherController extends CustomController
{
    public function __construct(TeacherRepository $repository, TeacherForm $form)
    {
        parent::__construct($repository, $form, 'teacher');
    }
}