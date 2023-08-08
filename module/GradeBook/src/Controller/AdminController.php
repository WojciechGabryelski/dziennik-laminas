<?php

namespace GradeBook\Controller;

use GradeBook\Entity\Repository\AdminRepository;
use GradeBook\Form\AdminForm;

class AdminController extends CustomController
{
    public function __construct(AdminRepository $repository, AdminForm $form)
    {
        parent::__construct($repository, $form, 'admin');
    }
}