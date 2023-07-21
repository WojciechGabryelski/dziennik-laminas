<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\AdminRepository;
use GradeBook\Form\AdminForm;
use Laminas\Form\FormInterface;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    private AdminRepository $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    public function indexAction(): ViewModel
    {
        return new ViewModel([
           "admins" => $this->repository->findAll(),
        ]);
    }

    public function addAction(): Response|array
    {
        $form = new AdminForm();
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
        return $this->redirect()->toRoute('admin', ['action' => 'index']);
    }

    public function editAction(): Response|array
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute('admin', ['action' => 'add']);
        }

        $admin = $this->repository->find($id);
        if ($admin == null) {
            return $this->redirect()->toRoute('admin', ['action' => 'index']);
        }

        $form = new AdminForm();
        $form->bind($admin);
        $form->get('submit')->setValue('Edit');

        $request = $this->getRequest();
        if (!$request->isPost()) {
            return ['id' => $id, 'form' => $form];
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return ['id' => $id, 'form' => $form];
        }

        $this->repository->update($admin, $form->getData(FormInterface::VALUES_AS_ARRAY));
        return $this->redirect()->toRoute('admin', ['action' => 'index']);
    }

    public function deleteAction(): Response|array
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ($id === 0) {
            return $this->redirect()->toRoute('admin', ['action' => 'index']);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->repository->delete($id);
            }

            return $this->redirect()->toRoute('admin');
        }

        return [
            'id'    => $id,
            'admin' => $this->repository->find($id),
        ];
    }
}