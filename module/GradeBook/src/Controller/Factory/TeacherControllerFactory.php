<?php

namespace GradeBook\Controller\Factory;

use GradeBook\Controller\TeacherController;
use GradeBook\Entity\Repository\Interface\TeacherRepositoryInterface;
use GradeBook\Form\TeacherForm;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TeacherControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): TeacherController
    {
        $formManager = $container->get('FormElementManager');
        return new TeacherController(
            $container->get(TeacherRepositoryInterface::class),
            $formManager->get(TeacherForm::class)
        );
    }
}