<?php

namespace GradeBook\Controller;

use DateTime;
use GradeBook\Entity\Repository\GradeRepository;
use GradeBook\Form\GradeForm;

class GradeController extends CustomController
{
    public function __construct(GradeRepository $repository, GradeForm $form)
    {
        parent::__construct($repository, $form, 'grade');
    }

    public function addData(): array
    {
        $teacherId = 0;
        $courses = $this->repository->getCoursesAndStudents($teacherId);
        return ['courses' => $courses];
    }

    public function performOperationsBeforeAction(array &$data): void
    {
        $data['studentCourse'] = $this->repository->findStudentCourse($data['studentCourse']);
        $data['date'] = new DateTime();
    }
}