<?php

namespace GradeBook\Controller\Factory;

use GradeBook\Controller\CourseController;
use GradeBook\Entity\Repository\Interface\CourseRepositoryInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class CourseControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new CourseController($container->get(CourseRepositoryInterface::class));
    }
}