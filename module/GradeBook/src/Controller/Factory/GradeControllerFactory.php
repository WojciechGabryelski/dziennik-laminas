<?php

namespace GradeBook\Controller\Factory;

use GradeBook\Controller\GradeController;
use GradeBook\Entity\Repository\Interface\GradeRepositoryInterface;
use GradeBook\Form\GradeForm;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class GradeControllerFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): GradeController
    {
        $formManager = $container->get('FormElementManager');
        return new GradeController(
            $container->get(GradeRepositoryInterface::class),
            $formManager->get(GradeForm::class)
        );
    }
}