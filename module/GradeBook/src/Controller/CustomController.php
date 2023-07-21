<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\CustomRepository;
use Laminas\Form\Form;
use Laminas\Form\FormInterface;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

abstract class CustomController extends AbstractActionController
{
    protected CustomRepository $repository;
    protected string $entityName;

    public function indexAction(): ViewModel
    {
        return new ViewModel([
            $this->entityName . "s" => $this->repository->findAll(),
        ]);
    }

    public function addAction(): Response|array
    {
        $form = $this->getNewFormInstance();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $this->repository->create($form->getData());
        return $this->redirect()->toRoute($this->entityName, ['action' => 'index']);
    }

    public function editAction(): Response|array
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute('admin', ['action' => 'add']);
        }

        $entity = $this->repository->find($id);
        if ($entity == null) {
            return $this->redirect()->toRoute($this->entityName, ['action' => 'index']);
        }

        $form = $this->getNewFormInstance();
        $form->bind($entity);
        $form->get('submit')->setValue('Edit');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return ['id' => $id, 'form' => $form];
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return ['id' => $id, 'form' => $form];
        }

        $entity->exchangeArray($form->getData(FormInterface::VALUES_AS_ARRAY));
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

    abstract public function getNewFormInstance(): Form;
}