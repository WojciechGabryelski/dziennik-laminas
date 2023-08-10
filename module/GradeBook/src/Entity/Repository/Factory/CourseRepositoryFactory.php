<?php

namespace GradeBook\Entity\Repository\Factory;

use Doctrine\ORM\Mapping\ClassMetadata;
use GradeBook\Entity\Course;
use GradeBook\Entity\Repository\CourseRepository;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class CourseRepositoryFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): CourseRepository
    {
        return new CourseRepository($container->get('doctrine.entitymanager.orm_default'), new ClassMetadata(Course::class));
    }
}