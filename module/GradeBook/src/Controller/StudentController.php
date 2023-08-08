<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\StudentRepository;
use GradeBook\Form\StudentForm;
use Laminas\Http\Response;
use Laminas\View\Model\ViewModel;

class StudentController extends CustomController {

    public function __construct(StudentRepository $repository, StudentForm $form)
    {
        parent::__construct($repository, $form, 'student');
    }

    public function showAction(): Response|ViewModel
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute('student', ['action' => 'add']);
        }

        $student = $this->repository->find($id);
        if ($student == null) {
            return $this->redirect()->toRoute('student', ['action' => 'index']);
        }

        return new ViewModel([
            $this->entityName => $student,
            'courses' => $this->repository->fetchAllGrades($id),
        ]);
    }
}