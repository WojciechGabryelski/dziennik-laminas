<?php

namespace GradeBook\Entity\Repository\Factory;

use Doctrine\ORM\Mapping\ClassMetadata;
use GradeBook\Entity\Repository\StudentRepository;
use GradeBook\Entity\Student;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class StudentRepositoryFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new StudentRepository($container->get('doctrine.entitymanager.orm_default'), new ClassMetadata(Student::class));
    }
}