<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\CourseRepository;
use GradeBook\Form\CourseForm;

class CourseController extends CustomController
{
    public function __construct(CourseRepository $repository, CourseForm $form)
    {
        parent::__construct($repository, $form, 'course');
    }

    public function addData(): array
    {
        $teachers = $this->repository->getTeachers();
        return ['teachers' => $teachers];
    }

    public function performOperationsBeforeAction(array &$data): void
    {
        $data['teacher'] = $this->repository->findTeacher($data['teacher']);
    }
}