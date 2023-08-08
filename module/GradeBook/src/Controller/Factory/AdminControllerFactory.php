<?php

namespace GradeBook\Controller\Factory;

use GradeBook\Controller\AdminController;
use GradeBook\Entity\Repository\Interface\AdminRepositoryInterface;
use GradeBook\Form\AdminForm;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class AdminControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): AdminController
    {
        $formManager = $container->get('FormElementManager');
        return new AdminController(
            $container->get(AdminRepositoryInterface::class),
            $formManager->get(AdminForm::class)
        );
    }
}