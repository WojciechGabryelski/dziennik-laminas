<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\CourseRepository;
use GradeBook\Form\CourseForm;

class CourseController extends CustomController
{
    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
        $this->entityName = 'course';
    }
    public function getNewFormInstance(): CourseForm
    {
        return new CourseForm();
    }
}