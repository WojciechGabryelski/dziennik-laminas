<?php

namespace GradeBook\Form\Fieldset;

use GradeBook\Entity\Course;
use GradeBook\Entity\Student;
use Laminas\Filter\ToInt;
use Laminas\Form\Element\Select;
use Laminas\Form\Fieldset;
use Laminas\InputFilter\InputFilterProviderInterface;

class StudentCourseFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init(): void
    {
        $this->add([
            'name'    => 'student',
            'type'    => Select::class,
            'options' => [
                'label' => 'Student',
                'empty_option' => 'Select student',
            ],
        ]);
        $this->add([
            'name'    => 'course',
            'type'    => Select::class,
            'options' => [
                'label' => 'Course',
                'empty_option' => 'Select course',
            ],
        ]);
    }

    public function getInputFilterSpecification(): array
    {
        return [
            'student' => [
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ],
            'course' => [
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ],
        ];
    }
}