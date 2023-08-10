<?php

namespace GradeBook\Entity\Repository\Factory;

use Doctrine\ORM\Mapping\ClassMetadata;
use GradeBook\Entity\Repository\StudentCourseRepository;
use GradeBook\Entity\StudentCourse;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class StudentCourseFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): StudentCourseRepository
    {
        return new StudentCourseRepository($container->get('doctrine.entitymanager.orm_default'), new ClassMetadata(StudentCourse::class));
    }
}