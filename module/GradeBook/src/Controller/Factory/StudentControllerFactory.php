<?php

namespace GradeBook\Controller\Factory;

use GradeBook\Controller\StudentController;
use GradeBook\Entity\Repository\Interface\StudentRepositoryInterface;
use GradeBook\Form\StudentForm;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class StudentControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): StudentController
    {
        $formManager = $container->get('FormElementManager');
        return new StudentController(
            $container->get(StudentRepositoryInterface::class),
            $formManager->get(StudentForm::class)
        );
    }
}