<?php

namespace GradeBook\Entity\Repository\Factory;

use Doctrine\ORM\Mapping\ClassMetadata;
use GradeBook\Entity\Repository\TeacherRepository;
use GradeBook\Entity\Teacher;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TeacherRepositoryFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new TeacherRepository($container->get('doctrine.entitymanager.orm_default'), new ClassMetadata(Teacher::class));
    }
}