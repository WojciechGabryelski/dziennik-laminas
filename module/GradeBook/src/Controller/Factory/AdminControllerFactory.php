<?php

namespace GradeBook\Controller\Factory;

use GradeBook\Controller\AdminController;
use GradeBook\Entity\Repository\Interface\AdminRepositoryInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class AdminControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new AdminController($container->get(AdminRepositoryInterface::class));
    }
}