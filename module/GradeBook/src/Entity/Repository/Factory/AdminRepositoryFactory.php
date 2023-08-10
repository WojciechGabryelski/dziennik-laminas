<?php

namespace GradeBook\Entity\Repository\Factory;

use Doctrine\ORM\Mapping\ClassMetadata;
use GradeBook\Entity\Admin;
use GradeBook\Entity\Repository\AdminRepository;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class AdminRepositoryFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): AdminRepository
    {
        return new AdminRepository($container->get('doctrine.entitymanager.orm_default'), new ClassMetadata(Admin::class));
    }
}