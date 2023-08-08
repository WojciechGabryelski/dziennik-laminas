<?php

namespace GradeBook\Controller\Factory;

use GradeBook\Controller\CourseController;
use GradeBook\Entity\Repository\Interface\CourseRepositoryInterface;
use GradeBook\Form\CourseForm;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class CourseControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): CourseController
    {
        $formManager = $container->get('FormElementManager');
        return new CourseController(
            $container->get(CourseRepositoryInterface::class),
            $formManager->get(CourseForm::class)
        );
    }
}