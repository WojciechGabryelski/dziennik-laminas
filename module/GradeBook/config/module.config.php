<?php

namespace GradeBook;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use GradeBook\Entity\Repository\Factory\AdminRepositoryFactory;
use GradeBook\Entity\Repository\Factory\CourseRepositoryFactory;
use GradeBook\Entity\Repository\Factory\GradeRepositoryFactory;
use GradeBook\Entity\Repository\Factory\StudentRepositoryFactory;
use GradeBook\Entity\Repository\Factory\TeacherRepositoryFactory;
use Laminas\Router\Http\Segment;

return [
    'service_manager' => [
        'aliases' => [
            Entity\Repository\Interface\AdminRepositoryInterface::class => Entity\Repository\AdminRepository::class,
            Entity\Repository\Interface\CourseRepositoryInterface::class => Entity\Repository\CourseRepository::class,
            Entity\Repository\Interface\GradeRepositoryInterface::class => Entity\Repository\GradeRepository::class,
            Entity\Repository\Interface\StudentRepositoryInterface::class => Entity\Repository\StudentRepository::class,
            Entity\Repository\Interface\TeacherRepositoryInterface::class => Entity\Repository\TeacherRepository::class,
        ],
        'factories' => [
            Entity\Repository\AdminRepository::class => AdminRepositoryFactory::class,
            Entity\Repository\CourseRepository::class => CourseRepositoryFactory::class,
            Entity\Repository\GradeRepository::class => GradeRepositoryFactory::class,
            Entity\Repository\StudentRepository::class => StudentRepositoryFactory::class,
            Entity\Repository\TeacherRepository::class => TeacherRepositoryFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'admin' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/admin[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action'     => 'index',
                    ]
                ],
            ],
            'student' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/student[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\StudentController::class,
                        'action'     => 'index',
                    ]
                ],
            ],
            'teacher' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/teacher[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\TeacherController::class,
                        'action'     => 'index',
                    ]
                ],
            ],
            'course' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/course[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CourseController::class,
                        'action'     => 'index',
                    ]
                ],
            ],
            'grade' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/grade[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\GradeController::class,
                        'action'     => 'index',
                    ]
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'gradeBook' => __DIR__ . '/../view'
        ]
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'Entity\Admin.php',
                    'Entity\Student.php',
                    'Entity\Teacher.php',
                    'Entity\Course.php',
                    'Entity\Grade.php',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `my_annotation_driver` for any entity under namespace `GradeBook\Entity`
                    'GradeBook\Entity' => 'my_annotation_driver',
                ],
            ],
        ],
    ],
];