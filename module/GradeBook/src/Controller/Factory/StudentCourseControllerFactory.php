<?php

namespace GradeBook\Controller\Factory;

use GradeBook\Controller\StudentCourseController;
use GradeBook\Entity\Repository\Interface\StudentCourseRepositoryInterface;
use GradeBook\Form\StudentCourseForm;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class StudentCourseControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $formManager = $container->get('FormElementManager');
        return new StudentCourseController(
            $container->get(StudentCourseRepositoryInterface::class),
            $formManager->get(StudentCourseForm::class)
        );
    }
}