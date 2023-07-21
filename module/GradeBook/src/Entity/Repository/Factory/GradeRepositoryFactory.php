<?php

namespace GradeBook\Entity\Repository\Factory;

use Doctrine\ORM\Mapping\ClassMetadata;
use GradeBook\Entity\Grade;
use GradeBook\Entity\Repository\GradeRepository;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class GradeRepositoryFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new GradeRepository($container->get('doctrine.entitymanager.orm_default'), new ClassMetadata(Grade::class));
    }
}