<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\CustomRepository;
use Laminas\Form\Form;
use Laminas\Form\FormInterface;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;

class CustomController extends AbstractActionController
{
    protected CustomRepository $repository;
    protected Form $form;
    protected string $entityName;

    public function __construct(CustomRepository $repository, Form $form, string $entityName)
    {
        $this->repository = $repository;
        $this->form = $form;
        $this->entityName = $entityName;
    }

    public function indexAction(): array
    {
        return [
            $this->entityName . "s" => $this->repository->findAll(),
        ];
    }

    public function addAction(): Response|array
    {
        $this->form->get('submit')->setValue('Add');
        $additionalData = $this->addData();

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return ['form' => $this->form] + $additionalData;
        }

        $this->form->setData($request->getPost());
        if (!$this->form->isValid()) {
            return ['form' => $this->form] + $additionalData;
        }

        $data = $this->form->getData(FormInterface::VALUES_AS_ARRAY);
        $this->performOperationsBeforeAction($data[$this->entityName]);
        $this->repository->create($data[$this->entityName]);
        return $this->redirect()->toRoute($this->entityName, ['action' => 'index']);
    }

    public function editAction(): Response|array
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute($this->entityName, ['action' => 'add']);
        }

        $entity = $this->repository->find($id);
        if ($entity == null) {
            return $this->redirect()->toRoute($this->entityName, ['action' => 'index']);
        }

        $this->form->bind($entity);
        $this->form->get('submit')->setValue('Edit');
        $additionalData = $this->addData();

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return ['id' => $id, 'form' => $this->form] + $additionalData;
        }

        $a = $request->getPost();
        $this->form->setData($request->getPost());
        if (!$this->form->isValid()) {
            return ['id' => $id, 'form' => $this->form] + $additionalData;
        }

        $data = $this->form->getData(FormInterface::VALUES_AS_ARRAY);
        $this->performOperationsBeforeAction($data[$this->entityName]);
        $entity->exchangeArray($data[$this->entityName]);
        $this->repository->update();
        return $this->redirect()->toRoute($this->entityName, ['action' => 'index']);
    }

    public function deleteAction(): Response|array
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute($this->entityName, ['action' => 'index']);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->repository->delete($id);
            }

            return $this->redirect()->toRoute($this->entityName);
        }

        return [
            'id'              => $id,
            $this->entityName => $this->repository->find($id),
        ];
    }

    public function addData(): array
    {
        return [];
    }

    public function performOperationsBeforeAction(array &$data): void
    {
    }
}