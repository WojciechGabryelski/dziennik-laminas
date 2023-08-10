<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\StudentCourseRepository;
use GradeBook\Form\StudentCourseForm;
use Laminas\Form\FormInterface;
use Laminas\Http\Response;

class StudentCourseController extends CustomController
{
    public function __construct(StudentCourseRepository $repository, StudentCourseForm $form)
    {
        parent::__construct($repository, $form, 'studentCourse');
    }

    public function editAction(): Response|array
    {
        $studentId = (int) $this->params()->fromRoute('studentId', 0);
        $courseId = (int) $this->params()->fromRoute('courseId', 0);
        if ($studentId === 0 || $courseId === 0) {
            return $this->redirect()->toRoute($this->entityName, ['action' => 'add']);
        }

        $entity = $this->repository->findByStudentAndCourse($studentId, $courseId);
        if ($entity == null) {
            return $this->redirect()->toRoute($this->entityName, ['action' => 'index']);
        }

        $this->form->bind($entity);
        $this->form->get('submit')->setValue('Edit');
        $additionalData = $this->addData();
        $additionalData += ['studentData' => $this->repository->findStudent($studentId)];

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return ['studentId' => $studentId, 'courseId' => $courseId, 'form' => $this->form] + $additionalData;
        }

        $this->form->setData($request->getPost());
        if (!$this->form->isValid()) {
            return ['studentId' => $studentId, 'courseId' => $courseId, 'form' => $this->form] + $additionalData;
        }

        $data = $this->form->getData(FormInterface::VALUES_AS_ARRAY);
        $this->performOperationsBeforeAction($data[$this->entityName]);
        $entity->exchangeArray($data[$this->entityName]);
        $this->repository->update();
        return $this->redirect()->toRoute($this->entityName, ['action' => 'index']);
    }

    public function deleteAction(): Response|array
    {
        $studentId = (int) $this->params()->fromRoute('studentId', 0);
        $courseId = (int) $this->params()->fromRoute('courseId', 0);
        if ($studentId === 0 || $courseId === 0) {
            return $this->redirect()->toRoute($this->entityName, ['action' => 'index']);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $studentId = (int) $request->getPost('studentId');
                $courseId = (int) $request->getPost('courseId');
                $this->repository->deleteByStudentAndCourse($studentId, $courseId);
            }

            return $this->redirect()->toRoute($this->entityName);
        }

        return [
            'studentId'       => $studentId,
            'courseId'        => $courseId,
            $this->entityName => $this->repository->findByStudentAndCourse($studentId, $courseId),
        ];
    }

    public function addData(): array
    {
        $teacherId = 0;
        $studentsCourses = $this->repository->getCoursesAndStudents($teacherId);
        return ['studentsCourses' => $studentsCourses];
    }

    public function performOperationsBeforeAction(array &$data): void
    {
        $data['student'] = $this->repository->findStudent($data['student']);
        $data['course'] = $this->repository->findCourse($data['course']);
    }
}