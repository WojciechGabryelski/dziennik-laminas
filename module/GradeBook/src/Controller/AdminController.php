<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\AdminRepository;
use GradeBook\Form\AdminForm;

class AdminController extends CustomController
{
    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
        $this->entityName = 'admin';
    }

    public function getNewFormInstance(): AdminForm
    {
        return new AdminForm();
    }
}