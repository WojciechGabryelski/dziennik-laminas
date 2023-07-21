<?php

namespace GradeBook\Controller\Factory;

use GradeBook\Controller\GradeController;
use GradeBook\Entity\Repository\Interface\GradeRepositoryInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class GradeControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new GradeController($container->get(GradeRepositoryInterface::class));
    }
}